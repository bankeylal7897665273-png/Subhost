<?php
// API aur App Configuration
$SITE_NAME = "Ai hero";
$API_URL = "https://b2k-wpapi.onrender.com"; // Aapka Render API
$DOMAIN_SUFFIX = ".surge.sh";

// JavaScript ke liye variables export kar rahe hain
echo "<script>
    const CONFIG = {
        siteName: '{$SITE_NAME}',
        apiUrl: '{$API_URL}',
        domainSuffix: '{$DOMAIN_SUFFIX}'
    };
    
    // Yahan apna real Firebase Config dalein
    const firebaseConfig = {
        apiKey: 'YOUR_FIREBASE_API_KEY',
        authDomain: 'YOUR_FIREBASE_AUTH_DOMAIN',
        projectId: 'YOUR_FIREBASE_PROJECT_ID',
        storageBucket: 'YOUR_FIREBASE_STORAGE_BUCKET',
        messagingSenderId: 'YOUR_FIREBASE_MESSAGING_SENDER_ID',
        appId: 'YOUR_FIREBASE_APP_ID'
    };
</script>";
?>
