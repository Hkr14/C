#pylint:disable=C0114
import logging
import os
from pyrogram import Client
from pyrogram.errors import RPCError
from pyrogram.errors import BadRequest
# import asyncio
# from pyrogram.errors import FloodWait
# from pyrogram.handlers import MessageHandler
# os.environ['TZ'] = 'Asia/Kolkata'



logging.basicConfig(level=logging.INFO)



bot = Client(
    'bot',
    api_id= 13532780, #get it from https://my.telegram.org/auth
    api_hash="f73ffaec3acf05270cde1dc63c561ef0", #get it from https://my.telegram.org/auth
    bot_token="5970810632:AAHbbIlFE4HDTsb01gST4gLpgLh_wTZDy1I", #get it from @Botfather
    plugins=dict(root="plugins"),
    parse_mode="html")


try:
    bot.run()
except Exception as e:
    print(e)
        