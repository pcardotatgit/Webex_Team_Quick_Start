# what is this code 

The **bot_logic.php** PHP script is a basic logic for very light Webex Team bot.

This script generate a **debug.txt** file which helps you to troubleshoot your bot if something doesn't work.

This script is a PHP script. That means that you must run it into any PHP web server.  

The first step is to install a PHP web server. I recommand XAMPP because it is very easy to install, on any operating system. It is very easy to use.

But for those of you who are familiar with such things, we just need either lighttpd, or appache, or nginx  and PHP installed with it and that's it.
Add a SQLite or MySQL database behind it will allow you to developp robust and powerfull server applications.


## Installation

### The PHP Script

Just copy and paste the PHP **bot_logic.php** script into a sub folder of your PHP web server and that's it.

For example if you installed Apache :

Copy the script for example into :

    htdocs\my_webex_team_bot\bot_logic.php

### Make your web server publickly availble

This is mandatory to make the Webex Team Bot Webhook to work. Webex Team must be able to reach your web server.

**For now let's install NGROK**

We assume here that you installed your Web Server into your laptop.  Which is the best to develop and test your bot logic before hosting it  anywhere else.

follow the bellow instruction for installing NGROK, and make you bot logic available to Webex Team in less than 5 minutes

[Install NGROK](https://developer.cisco.com/learning/lab/collab-spark-botkit/step/4)


- **1 - Start Your Web Server**
- **2 - Start NGROK**
- **3 - Open You Browser onto the NGROK Generated Public Domain Name**

You should have access to your PHP webserver.

**Configure your Bot logic URL in Your Webex Team Bot**

After that go to Webex Team and configure a WebHook for your Webex Team Bot. Use the public URL of your bot logic as the webhook target URL ( 

In developer.webex.com go to **Webhooks** :

- Bearer token =  Bot Webex Token
- Name = any_name
- TargetURL = Public url of this PHP script
- resources = messages
- event = created

**Adjust the init_key_and_bot_id.txt file configuration**
In this PHP script You must configure :

- <DESTINATION_ROOM_ID> of the Webex Team room into which youn communicate with your bot
- <BOT_ACCESS_TOKEN> : The Webex Team bot's token

And you are ready to go !

#Test#

Open Webex Team, go to the BOT Room and send **ping**

Your bot should reply to you :

**-bot: Yeah !! I received your ping message !**

For debugging, open the **debug.txt** in the same directory as your php script

After that you can send some commands to your script like:

**ping**

**-hello**

**-with something** intent to send to the bot a message to compute.

Look into the code at line 137 (**if(stripos($messageData,"bot:")==false)**

The message parser starts here and it is almost empty.   You have make your changes if you want to make your bot to be smart

Have a look how this if statement is written

#tips#

If during your development you fall into a loop ( the bot loop into sending infinetely the same message ) then go into your php script and create an error. like adding anywhere in the script anything like **stop**. It will break the loop