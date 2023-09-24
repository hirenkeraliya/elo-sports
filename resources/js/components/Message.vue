<template>
   
    <div class="message-lists" >
      
        <div class="card-body msg_card_body" v-for="message in messages">
							<div class="d-flex justify-content-start mb-4" v-if="message.user.id != user">
								<div class="img_cont_msg">
									<!-- <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg"> -->
                                    <img :src="message.user.imageLink" class="rounded-circle user_img_msg" />
                                    
								</div>
								<div class="msg_cotainer">
                                    {{ message.message }} 
									
								
                                <div class="msg_time">  {{ message.createAt}}</div>
							</div>
                        </div>
							<div class="d-flex justify-content-end mb-4" v-else>
								<div class="msg_cotainer_send">
                                    {{ message.message }}
                               
									<div class="msg_time_send"> {{ message.createAt}}</div>
								</div>
								<div class="img_cont_msg">
                                    
                                <img :src="user_image" class="rounded-circle user_img_msg" v-if="user_image">
								
							<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg" v-else>
								</div>
							</div>
							
						</div>
    <!-- <div class="is-clearfix">
        <div class="notification is-info is-pulled-left" v-if="message.user.id != user">
            <small>Sent by {{ message.user.username }}</small><br/>
            {{ message.message }}    
        </div>
    
        <div class="notification is-primary is-pulled-right"  v-else>{{ message.message }}</div>
    </div> -->
    
    </div>
</template>

<script>
export default {
    props: [
        'messages',
        'user',
        'user_image'
    ]
}
</script>

<style scoped>
.notification {
    width: 80%;
    margin-bottom: 1em;
}

small {
    color: #ccc;
    font-size: 0.65em;
}
.img_cont_msg {
    height: 40px;
    width: 40px;
}

.msg_cotainer {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 25px;
    background-color: #82ccdd;
    padding: 10px;
    position: relative;
    min-width: 80px;
}
.msg_time {
    position: absolute;
    left: 0;
    bottom: -15px;
    color: rgb(20 18 18 / 50%);
    font-size: 10px;
}
.msg_cotainer_send {
    margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 25px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;
    min-width: 80px;
}

.msg_time_send {
    position: absolute;
    right: 0;
    bottom: -15px;
    color: rgb(20 18 18 / 50%);
    font-size: 10px;
}
</style>
