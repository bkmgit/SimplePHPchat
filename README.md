# SimplePHPchat
A chat application in PHP

# Installation and use

To install and use this on a fresh install CENT OS 7 virtual machine first:

* ```sudo yum update```

Get Apache server

* ```sudo yum install httpd```

Install database

* ```sudo yum install mariadb-server mariadb```

* ```sudo systemctl start mariadb```

Secure database

* ```sudo mysql_secure_installation```

* ```sudo systemctl enable mariadb.service```

* ```sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm```

* ```sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm```

* ```sudo yum -y install httpd php70w php70w-dom php70w-mbstring php70w-gd php70w-pdo php70w-json php70w-xml php70w-zip php70w-curl php70w-mcrypt php70w-pear setroubleshoot-server php70w-soap php70w-snmp php70w-mysql php70w-pdo php70w-intl```

* ```sudo systemctl enable httpd.service```

Setup database

* ```mysql -u root -p```

options should be

* ```CREATE DATABASE myChat;```

* ```GRANT ALL ON myChat.* to 'mychatuser'@'localhost' IDENTIFIED BY 'a_password_of_your_choice';```

* ```FLUSH PRIVILEGES;```

* ```EXIT;```

* ```sudo systemctl restart httpd.service```

Go to web directory and place files in

/var/www/html/startchat

/var/www/html/chat

/var/www/html/endchat

## The program has benefitted from material at:

* https://www.formget.com/how-to-redirect-a-url-php-form/
* https://github.com/Flynsarmy/PHPWebSocket-Chat
* http://blog.alakmalak.com/build-a-chat-application-with-silex-using-php/
* http://phppot.com/php/simple-php-chat-using-websocket/
* http://seregazhuk.github.io/2017/06/22/reactphp-chat-server/
* https://github.com/seregazhuk/reactphp-blog-series
* http://seregazhuk.github.io/2017/06/24/reactphp-chat-client/
* https://socket.io/get-started/chat/
* https://github.com/antirez/retwis
* https://phpdelusions.net/pdo
* http://www.phptherightway.com/#pdo_extension
* http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Getting_Row_Count
* https://www.w3schools.com/php/php_sessions.asp
* http://php.net/manual/en/language.operators.string.php
* https://stackoverflow.com/questions/7964917/how-to-store-variable-values-over-multiple-page-loads
* https://www.script-tutorials.com/guide-on-creating-a-chat-room-using-jqueryphp/
* https://www.w3schools.com/html/html_paragraphs.asp
* https://www.script-tutorials.com/how-to-easily-make-a-php-chat-application/
* https://www.codeproject.com/Articles/649771/Chat-Application-in-PHP
* https://github.com/OpenSC/OpenSC/wiki/Spanish-Ceres-DNIe
* https://github.com/ksubileau/zzChat/tree/master/tests
* https://www.codeproject.com/articles/637657/html-real-time-chat-with-websockets-jquery-and-sp
* https://github.com/emitter-io/emitter
* https://github.com/nextcloud/spreed/issues/35


## Acknowledgements
Günther Froelich
