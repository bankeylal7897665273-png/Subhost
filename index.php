<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ai hero</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #f5f7fa; color: #333; opacity: 0; animation: fadeIn 0.8s forwards; scroll-behavior: smooth; }
        @keyframes fadeIn { to { opacity: 1; } }
        
        /* Navbar */
        .navbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 100; }
        .logo { color: #1a73e8; font-size: 20px; font-weight: bold; display: flex; align-items: center; gap: 8px; }
        .logo-icon { width: 24px; height: 24px; background: #1a73e8; color: white; display: flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 12px; }
        .nav-links a { margin-left: 20px; text-decoration: none; color: #555; font-weight: 500; transition: 0.3s; cursor: pointer; }
        .nav-links a:hover { color: #1a73e8; }
        
        /* Main Container */
        .container { max-width: 800px; margin: 40px auto; padding: 20px; text-align: center; }
        .title { color: #1a73e8; font-size: 28px; margin-bottom: 10px; font-weight: bold; }
        h1 { font-size: 36px; margin-bottom: 40px; }
        
        /* Form Card */
        .card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 30px; margin-bottom: 30px; transition: transform 0.5s ease; }
        .card:hover { transform: translateY(-5px); }
        
        /* Domain Input */
        .domain-group { display: flex; margin-bottom: 30px; align-items: center; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .domain-group input { flex: 1; padding: 15px; border: none; font-size: 16px; outline: none; }
        .domain-suffix { background: #f8f9fa; padding: 15px 20px; color: #1a73e8; font-weight: 600; border-left: 1px solid #ddd; }
        
        /* Tabs */
        .tabs { display: flex; border-bottom: 2px solid #eee; margin-bottom: 20px; }
        .tab { flex: 1; padding: 15px; text-align: center; cursor: pointer; font-weight: 600; color: #777; transition: 0.3s; }
        .tab.active { color: #1a73e8; border-bottom: 2px solid #1a73e8; }
        
        /* Upload Area */
        .tab-content { display: none; animation: fadeIn 0.5s forwards; }
        .tab-content.active { display: block; }
        .upload-box { border: 2px dashed #1a73e8; border-radius: 12px; padding: 40px 20px; background: #f8fcfd; transition: 0.3s; position: relative; }
        .upload-box:hover { background: #eef7ff; }
        .upload-icon { font-size: 40px; color: #a8c7fa; margin-bottom: 15px; }
        .btn-upload { background: #1a73e8; color: white; padding: 10px 24px; border: none; border-radius: 20px; font-weight: 600; cursor: pointer; margin: 10px 5px; transition: 0.3s; }
        .btn-upload:hover { background: #1557b0; }
        .file-info { margin-top: 15px; font-size: 14px; color: #555; }
        
        /* Paste Code Area */
        textarea { width: 100%; height: 250px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; font-family: monospace; font-size: 14px; outline: none; resize: vertical; background: #1e1e1e; color: #d4d4d4; }
        textarea:focus { border-color: #1a73e8; }
        
        /* Action Button */
        .btn-deploy { background: #1a73e8; color: white; padding: 16px 40px; border: none; border-radius: 24px; font-size: 18px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 20px; width: 100%; box-shadow: 0 4px 15px rgba(26, 115, 232, 0.4); }
        .btn-deploy:hover { transform: scale(1.02); box-shadow: 0 6px 20px rgba(26, 115, 232, 0.6); }
        .btn-deploy:disabled { background: #a8c7fa; cursor: not-allowed; transform: none; box-shadow: none; }
        
        /* Loader Overlay */
        .loader-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.95); z-index: 1000; display: none; flex-direction: column; justify-content: center; align-items: center; }
        .progress-circle { width: 120px; height: 120px; border: 8px solid #f3f3f3; border-top: 8px solid #1a73e8; border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 20px; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .progress-text { font-size: 24px; font-weight: bold; color: #1a73e8; }
        .loader-status { margin-top: 10px; color: #555; font-size: 16px; }

        /* Hidden Inputs */
        input[type="file"] { display: none; }
    </style>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <?php include 'config.php'; ?>
</head>
<body>

    <div class="navbar">
        <div class="logo">
            <div class="logo-icon">Ai</div> Ai hero
        </div>
        <div class="nav-links">
            <a href="my-list.php">My List</a>
            <a id="logoutBtn">Log Out</a>
        </div>
    </div>

    <div class="container">
        <div class="title">Ai hero Makers Drop</div>
        <h1>Free Website Hosting</h1>

        <div class="card">
            <div class="domain-group">
                <input type="text" id="domainInput" placeholder="Enter your domain name" required>
                <div class="domain-suffix" id="domainSuffix"></div>
            </div>

            <div class="tabs">
                <div class="tab active" onclick="switchTab('upload')">Upload Files</div>
                <div class="tab" onclick="switchTab('paste')">Paste Code</div>
            </div>

            <div id="uploadTab" class="tab-content active">
                <div class="upload-box" id="dropZone">
                    <div class="upload-icon">Cloud</div>
                    <button class="btn-upload" onclick="document.getElementById('fileInput').click()">Select File / ZIP</button>
                    <button class="btn-upload" onclick="document.getElementById('folderInput').click()">Select Folder</button>
                    <input type="file" id="fileInput" accept=".zip,.html,.css,.js,.png,.jpg">
                    <input type="file" id="folderInput" webkitdirectory directory multiple>
                    <div class="file-info" id="fileInfo">Upload website file archives, images, documents, or single file limit 25MB</div>
                </div>
            </div>

            <div id="pasteTab" class="tab-content">
                <textarea id="codePaste" placeholder="Paste your HTML code here. It will be saved as index.html"></textarea>
            </div>

            <button class="btn-deploy" id="deployBtn">Start Deployment</button>
        </div>
    </div>

    <div class="loader-overlay" id="loaderOverlay">
        <div class="progress-circle"></div>
        <div class="progress-text" id="progressText">0%</div>
        <div class="loader-status" id="loaderStatus">Zipping files...</div>
    </div>

    <script>
        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        auth.onAuthStateChanged(user => {
            if (!user) window.location.href = 'login.php';
        });

        document.getElementById('logoutBtn').addEventListener('click', () => {
            auth.signOut();
        });

        // URL Params check for replacing
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('domain')) {
            document.getElementById('domainInput').value = urlParams.get('domain').replace(CONFIG.domainSuffix, '');
        }

        document.getElementById('domainSuffix').innerText = CONFIG.domainSuffix;

        let selectedFiles = [];
        let uploadType = 'none'; // none, file, folder, paste

        function switchTab(tab) {
            document.getElementById('uploadTab').classList.remove('active');
            document.getElementById('pasteTab').classList.remove('active');
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            
            if(tab === 'upload') {
                document.getElementById('uploadTab').classList.add('active');
                document.querySelectorAll('.tab')[0].classList.add('active');
            } else {
                document.getElementById('pasteTab').classList.add('active');
                document.querySelectorAll('.tab')[1].classList.add('active');
                uploadType = 'paste';
            }
        }

        // File Selection Logic
        document.getElementById('fileInput').addEventListener('change', function(e) {
            if(this.files.length > 0) {
                selectedFiles = this.files;
                uploadType = 'file';
                document.getElementById('fileInfo').innerHTML = `<b>Selected File:</b> ${this.files[0].name} (${(this.files[0].size/1024).toFixed(2)} KB)`;
            }
        });

        document.getElementById('folderInput').addEventListener('change', function(e) {
            if(this.files.length > 0) {
                selectedFiles = this.files;
                uploadType = 'folder';
                document.getElementById('fileInfo').innerHTML = `<b>Selected Folder:</b> ${this.files.length} files found.`;
            }
        });

        // Generate Random ID for history
        function generateId() {
            return Math.random().toString(36).substr(2, 9);
        }

        // Save to History (Local Storage)
        function saveToHistory(domainStr, fullUrl) {
            let history = JSON.parse(localStorage.getItem('deployHistory') || '[]');
            history.push({
                id: generateId(),
                domain: domainStr,
                url: fullUrl,
                date: new Date().toLocaleString()
            });
            localStorage.setItem('deployHistory', JSON.stringify(history));
        }

        // Deploy Button Logic
        document.getElementById('deployBtn').addEventListener('click', async () => {
            const subdomain = document.getElementById('domainInput').value.trim();
            if(!subdomain) {
                alert("Please enter a domain name.");
                return;
            }

            const overlay = document.getElementById('loaderOverlay');
            const progressText = document.getElementById('progressText');
            const loaderStatus = document.getElementById('loaderStatus');
            const deployBtn = document.getElementById('deployBtn');

            if(uploadType === 'none' && document.getElementById('uploadTab').classList.contains('active')) {
                alert("Please select a file or folder.");
                return;
            }

            overlay.style.display = "flex";
            deployBtn.disabled = true;

            let zipBlob = null;

            try {
                // Simulate Loading 0 to 40%
                let progress = 0;
                let intv = setInterval(() => {
                    if(progress < 40) { progress += 1; progressText.innerText = progress + "%"; }
                }, 50);

                const zip = new JSZip();

                if(document.getElementById('pasteTab').classList.contains('active')) {
                    loaderStatus.innerText = "Processing pasted code...";
                    const code = document.getElementById('codePaste').value;
                    if(!code) throw new Error("Code is empty.");
                    zip.file("index.html", code);
                    zipBlob = await zip.generateAsync({type:"blob"});
                } 
                else if(uploadType === 'file') {
                    loaderStatus.innerText = "Processing file...";
                    const file = selectedFiles[0];
                    if(file.name.endsWith('.zip')) {
                        // User uploaded a ZIP, use it directly
                        zipBlob = file;
                    } else {
                        // Single file uploaded, zip it
                        zip.file(file.name, file);
                        zipBlob = await zip.generateAsync({type:"blob"});
                    }
                } 
                else if(uploadType === 'folder') {
                    loaderStatus.innerText = "Zipping folder contents...";
                    for (let i = 0; i < selectedFiles.length; i++) {
                        const file = selectedFiles[i];
                        // file.webkitRelativePath contains the folder structure
                        const path = file.webkitRelativePath || file.name;
                        zip.file(path, file);
                    }
                    zipBlob = await zip.generateAsync({type:"blob"});
                }

                clearInterval(intv);
                progress = 50;
                progressText.innerText = progress + "%";
                loaderStatus.innerText = "Sending to API...";

                // API Request Call
                const formData = new FormData();
                formData.append("subdomain", subdomain); // Surge format support
                formData.append("zip_file", zipBlob, "upload.zip");

                // Loader animate from 50 to 90
                intv = setInterval(() => {
                    if(progress < 90) { progress += 1; progressText.innerText = progress + "%"; }
                }, 200);

                const response = await fetch(`${CONFIG.apiUrl}/deploy`, {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                clearInterval(intv);

                if(data.status === "success" || response.ok) {
                    progressText.innerText = "100%";
                    loaderStatus.innerText = "Deployment Successful!";
                    
                    // Allow custom API response URL or construct our own
                    const finalDomain = subdomain + CONFIG.domainSuffix;
                    const finalUrl = data.url ? data.url : `https://${finalDomain}`;
                    
                    saveToHistory(finalDomain, finalUrl);

                    setTimeout(() => {
                        window.location.href = `deploy.php?domain=${encodeURIComponent(finalDomain)}&url=${encodeURIComponent(finalUrl)}`;
                    }, 1000);
                } else {
                    throw new Error(data.message || "Failed to deploy on server.");
                }

            } catch (error) {
                overlay.style.display = "none";
                deployBtn.disabled = false;
                alert("Deploy Failed! Server se connect nahi ho paya ya error aaya.\n" + error.message);
            }
        });
    </script>
</body>
</html>
