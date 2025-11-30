<?php
    if(password_verify('123456789','$2y$10$baawUh9Z0Vba2Gr7kmUWUeopkHYvoB5kdemIxtRTq6KgPCmHY4YOy'))
        echo "Mật khẩu đúng";
    else    
        echo "Sai mật khẩu";
?>