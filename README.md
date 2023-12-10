<h2>Chat application</h2>
<h5>This application made using bootstrap,PHP and Mysql </h5>
![Screenshot (108)](https://github.com/tonytverma/chat_site/assets/82827111/e182ec66-84c2-4a5d-af48-6ee46dd2e1ed)
![Screenshot (109)](https://github.com/tonytverma/chat_site/assets/82827111/06bab5a7-1775-4cbd-abe0-a829eb4046e6)

<h3>Features</h3>
<ol>
  <li>Real-time communication between a friends</li>
  <li>Uses Mysql as database</li>
  <li>used PHP as backed language</li>
</ol>
<h3>database</h3>
<ul>
  <li>Users - This table store information about user with Primary key 'user_id', attributes of this table are username,name,profile_pic,active,user_password and Email.</li>
  <li>Chats - This table store information about Chats between friends with Primary key 'chat_id' and Foreign keys 'sender_id','reciver_id', attributes of this table are message,send_time and seen.</li> 
  <li>friends - This table store information about relationship between friends with Primary key 'relation_id' and Foreign key 'friend_id','user_id'.</li> 
</ul>
