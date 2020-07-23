#what is it#

This script is a basic logic for start / test your first Webex Team bot.

This script is a PHP script. You must run it into any PHP web server.  Just copy and paste the script into a sub folder of your PHP web server and that's it.

After that configure a WebHook for your Webex Team Bot, And use the public URL of your bot logic as the webhook target URL ( 

In developer.webex.com go to **Webhooks** :

- Bearer token =  Bot Webex Token
- Name = any_name
- TargetURL = Public url of this PHP script
- resources = messages
- event = created

In this PHP script You must configure :

- <Room_ID> of the Webex Team room into which youn communicate with your bot
- <Bot_Webex_Token> : The Webex Team bot's token

And you are ready to go !

#Test#

Open Webex Team, go to the BOT Room and send **ping**

Your bot should reply to you :

**Yeah !! I received your ping message !**

For debugging, open the **debug.txt** in the same directory as your php script

After that you can send :

**@bot: ping**

**@bot: hello**

**@bot: ( with something )** intent to send to the bot a message to compute.

But look into the code and make any changes you want to make your bot smart

#tips#

If during your development you fall into a loop ( the bot loop into sending infinetely the same message ) then go into your php script and create an error. like adding anywhere in the script anything like **stop**. It will break the loop