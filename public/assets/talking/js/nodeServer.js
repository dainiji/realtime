var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );
var app = express();
var server = http.createServer( app );
var io = socket.listen( server );
var onlineUsers = {};

io.sockets.on( 'connection', function( client ) {
	console.log( "New client !" );
	


	client.on("i_am_online", function(data){
		if(data in onlineUsers){
			//Do Somthing Later
		} else{
			client.user_id = data;
			client.open_timestamp = new Date().getTime();
			onlineUsers[client.user_id] = client;
			io.sockets.emit("new_user_online",data)
		}
	});

	client.on("update_user_socket", function(data){
		if(data in onlineUsers){
			//do somthing later 
		} else{
			//Broadcast to All 
			io.sockets.emit("new_user_online",data)
		}

		console.log("update user socket"+data);
		client.user_id = data;
		client.open_timestamp = new Date().getTime();
		onlineUsers[client.user_id] = client;
		console.log("update user socket id"+data);


		
	});


	client.on( 'message', function( data ) {
		console.log( 'Chat Id ' + data.chatId );
		console.log( 'Message :' + data.message );
		console.log( 'SenderId ' + data.senderId );
		console.log( 'ReceiverId ' + data.receiverId );
		console.log( 'SenderName ' + data.senderName );
		console.log( 'ReceiverName ' + data.receiverName );


		onlineUsers[data.senderId].emit('new_message',data);
		if(data.receiverId in onlineUsers){
			onlineUsers[data.receiverId].emit('new_message',data);
			console.log(data.receiverId+" : is online");
		} else {
			console.log(data.receiverId+" is not online");
			//We will do somthing
		}		
	});
});

server.listen( 8080 );