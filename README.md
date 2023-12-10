<h2>Chat application</h2>
<h5>This application made using bootstrap,PHP and Mysql </h5>

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
