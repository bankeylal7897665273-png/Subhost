<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Deploy - Ai hero</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #f5f7fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; opacity: 0; animation: fadeIn 0.8s forwards; }
        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
        
        .card { background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 50px 40px; text-align: center; max-width: 500px; width: 100%; transform: translateY(20px); animation: fadeIn 0.8s forwards; }
        .success-icon { width: 80px; height: 80px; background: #e6f4ea; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px; color: #34a853; font-size: 40px; font-weight: bold; }
        h1 { color: #333; font-size: 28px; margin-bottom: 10px; }
        p { color: #666; margin-bottom: 30px; font-size: 16px; }
        
        .url-box { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; border-radius: 8px; font-size: 18px; color: #1a73e8; font-weight: 600; margin-bottom: 30px; word-break: break-all; }
        
        .btn-group { display: flex; flex-direction: column; gap: 15px; }
        .btn { padding: 16px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-primary { background: #1a73e8; color: white; box-shadow: 0 4px 15px rgba(26, 115, 232, 0.3); }
        .btn-primary:hover { background: #1557b0; box-shadow: 0 6px 20px rgba(26, 115, 232, 0.4); transform: translateY(-2px); }
        .btn-outline { background: transparent; border: 2px solid #1a73e8; color: #1a73e8; }
        .btn-outline:hover { background: #f8f9fa; }
        .btn-replace { background: #f1f3f4; color: #5f6368; }
        .btn-replace:hover { background: #e8eaed; }
        
        .copy-toast { position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 10px 20px; border-radius: 30px; display: none; font-size: 14px; }
    </style>
</head>
<body>

    <div class="card">
        <div class="success-icon">Check</div>
        <h1>Successful Deploy</h1>
        <p>Your website is now live globally on our edge network.</p>
        
        <div class="url-box" id="siteUrl">loading...</div>

        <div class="btn-group">
            <button class="btn btn-primary" id="visitBtn">Visit Site</button>
            <button class="btn btn-outline" id="copyBtn">Copy URL</button>
            <button class="btn btn-replace" id="replaceBtn">Replace / Update Code</button>
        </div>
    </div>

    <div class="copy-toast" id="toast">URL Copied to clipboard!</div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const domain = urlParams.get('domain');
        let fullUrl = urlParams.get('url');

        if(!fullUrl && domain) { fullUrl = "https://" + domain; }

        document.getElementById('siteUrl').innerText = fullUrl || "No URL provided";

        document.getElementById('visitBtn').addEventListener('click', () => {
            if(fullUrl) window.open(fullUrl, '_blank');
        });

        document.getElementById('copyBtn').addEventListener('click', () => {
            if(fullUrl) {
                navigator.clipboard.writeText(fullUrl).then(() => {
                    const toast = document.getElementById('toast');
                    toast.style.display = "block";
                    setTimeout(() => { toast.style.display = "none"; }, 2000);
                });
            }
        });

        document.getElementById('replaceBtn').addEventListener('click', () => {
            // Redirect back to index with domain name prefilled to lock it
            window.location.href = `index.php?domain=${encodeURIComponent(domain)}`;
        });
    </script>
</body>
</html>
