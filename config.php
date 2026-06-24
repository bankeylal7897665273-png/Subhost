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
  apiKey: "AIzaSyAx_lir4lbck0m5ExjgSMVRwQ32TpcLKcA",
  authDomain: "sent-b88cf.firebaseapp.com",
  databaseURL: "https://sent-b88cf-default-rtdb.firebaseio.com",
  projectId: "sent-b88cf",
  storageBucket: "sent-b88cf.firebasestorage.app",
  messagingSenderId: "472674174510",
  appId: "1:472674174510:web:ff573430e68b6c4ac281bf"
};

</script>";
?>
