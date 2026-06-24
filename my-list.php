<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Deployments - Ai hero</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #f5f7fa; color: #333; opacity: 0; animation: fadeIn 0.8s forwards; }
        @keyframes fadeIn { to { opacity: 1; } }
        
        .navbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { color: #1a73e8; font-size: 20px; font-weight: bold; display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .logo-icon { width: 24px; height: 24px; background: #1a73e8; color: white; display: flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 12px; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: #555; font-weight: 500; transition: 0.3s; cursor: pointer; }
        .nav-links a:hover { color: #1a73e8; }

        .container { max-width: 900px; margin: 40px auto; padding: 20px; }
        h1 { font-size: 28px; margin-bottom: 30px; color: #1a73e8; }

        .list-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; transition: transform 0.3s; border-left: 4px solid #1a73e8; }
        .list-card:hover { transform: translateX(5px); }
        .info h3 { margin-bottom: 5px; font-size: 18px; }
        .info a { color: #1a73e8; text-decoration: none; font-size: 14px; }
        .info a:hover { text-decoration: underline; }
        .info .date { font-size: 12px; color: #888; margin-top: 5px; }

        .actions button { padding: 8px 16px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: 0.3s; margin-left: 10px; }
        .btn-visit { background: #e8f0fe; color: #1a73e8; }
        .btn-visit:hover { background: #d2e3fc; }
        .btn-update { background: #1a73e8; color: white; }
        .btn-update:hover { background: #1557b0; }
        .empty-state { text-align: center; padding: 50px; color: #777; font-size: 18px; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php" class="logo">
            <div class="logo-icon">Ai</div> Ai hero
        </a>
        <div class="nav-links">
            <a href="index.php">Dashboard</a>
        </div>
    </div>

    <div class="container">
        <h1>My Deployments</h1>
        <div id="listContainer"></div>
    </div>

    <script>
        const history = JSON.parse(localStorage.getItem('deployHistory') || '[]');
        const container = document.getElementById('listContainer');

        if(history.length === 0) {
            container.innerHTML = `<div class="empty-state">No deployments found. Start your first deployment!</div>`;
        } else {
            // Reverse to show latest first
            history.reverse().forEach(item => {
                const card = document.createElement('div');
                card.className = 'list-card';
                card.innerHTML = `
                    <div class="info">
                        <h3>${item.domain}</h3>
                        <a href="${item.url}" target="_blank">${item.url}</a>
                        <div class="date">Deployed on: ${item.date}</div>
                    </div>
                    <div class="actions">
                        <button class="btn-visit" onclick="window.open('${item.url}', '_blank')">Visit</button>
                        <button class="btn-update" onclick="window.location.href='index.php?domain=${item.domain}'">Update</button>
                    </div>
                `;
                container.appendChild(card);
            });
        }
    </script>
</body>
</html>
