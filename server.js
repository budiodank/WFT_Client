const PushNotifications = require('@pusher/push-notifications-server');

let beamsClient = new PushNotifications({
  instanceId: '4c80e9f4-4a8e-4cc5-b864-7941faaed944',
  secretKey: 'E16E02AD03ACB8B2ABA8913C9A559A170BC1BAF270A7855AB911C254884135D0'
});

beamsClient.publish(['notif'], {
  fcm: {
    notification: {
      title: 'Notif App',
      body: 'Hello, I can I can I can'
    }
  }
}).then((publishResponse) => {
  console.log('Just published:', publishResponse.publishId);
}).catch((error) => {
  console.log('Error:', error);
});