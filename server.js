const express = require('express');
const path = require('path');
const http = require('http');
const https = require('https');

const app = express();
const PORT = process.env.PORT || 3000;

// WordPress local URL — change WP_URL env var if your WP runs at a different address
const WP_URL = (process.env.WP_URL || 'http://localhost').replace(/\/$/, '');

// Proxy: fetch gallery from WordPress REST API, fall back to static JSON
app.get('/api/gallery', (req, res) => {
    // orderby=menu_order is NOT allowed in WP REST API by default — removed to avoid 400 error
    const apiUrl = `${WP_URL}/wp-json/wp/v2/dh_gallery?per_page=100&_embed=1`;
    const client = apiUrl.startsWith('https') ? https : http;

    console.log(`[gallery] Fetching: ${apiUrl}`);

    const wpReq = client.get(apiUrl, (wpRes) => {
        let raw = '';
        wpRes.on('data', chunk => { raw += chunk; });
        wpRes.on('end', () => {
            try {
                const posts = JSON.parse(raw);

                if (!Array.isArray(posts)) {
                    console.error('[gallery] WordPress returned non-array. Status:', wpRes.statusCode);
                    console.error('[gallery] Response body:', raw.slice(0, 500));
                    return serveFallback(res, 'wp-error');
                }

                const images = posts.reduce((acc, post) => {
                    const media = post._embedded && post._embedded['wp:featuredmedia'];
                    if (media && media[0] && media[0].source_url) {
                        acc.push({
                            src: media[0].source_url,
                            alt: media[0].alt_text || post.title?.rendered || 'Dian Huo Hotpot',
                        });
                    } else {
                        console.warn(`[gallery] Post ID ${post.id} ("${post.title?.rendered}") has no featured image — skipped`);
                    }
                    return acc;
                }, []);

                console.log(`[gallery] WordPress returned ${posts.length} posts → ${images.length} with featured images`);
                res.set('Cache-Control', 'no-store, no-cache, must-revalidate');
                res.set('Pragma', 'no-cache');
                res.json({ source: 'wordpress', images });
            } catch (err) {
                console.error('[gallery] JSON parse error:', err.message);
                serveFallback(res, 'parse-error');
            }
        });
    });

    wpReq.setTimeout(5000, () => {
        console.error(`[gallery] WordPress timed out after 5s at ${apiUrl}`);
        wpReq.destroy();
        serveFallback(res, 'timeout');
    });
    wpReq.on('error', (err) => {
        console.error(`[gallery] Cannot reach WordPress at ${WP_URL}:`, err.message);
        serveFallback(res, 'connection-error');
    });
});

function serveFallback(res, reason) {
    console.warn(`[gallery] Using static fallback (reason: ${reason})`);
    res.set('Cache-Control', 'no-store, no-cache, must-revalidate');
    res.sendFile(path.join(__dirname, 'public', 'content', 'gallery.json'));
}

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.listen(PORT, () => {
  console.log(`Dian Huo server running on port ${PORT}`);
  console.log(`WordPress URL  : ${WP_URL}`);
  console.log(`Gallery proxy  : http://localhost:${PORT}/api/gallery`);
  console.log(`WP REST test   : ${WP_URL}/wp-json/wp/v2/dh_gallery?per_page=1`);
  console.log(`(Set WP_URL env var if WordPress runs at a different address)`);
});
