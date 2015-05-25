# GOODS
GOODS

http://104.236.5.192 adresimize post olarak parameters içerisinde base64 encodelanmış olarak request atıyoruz. Şimdilik apiler bunlar...daha da yazılcak...sen entegre etmeye başla ihtiyaç oldukça da yazarım yeni apiler


_____________________________________________________________________________________________
api/NewItem
//Request
{
	"latitude":45.8990,
	"user_id":2,
	"longtitude":-97.456,
	"title":"Egemen's coffe",
	"description":"drink it responsibly",
	"price":54.678,
	"category_id":7878,
	"trade":1
}


//Response

{"status":0,"message":"failed to insert!","body":null}

or

{"status":1,"message":"new item inserted!","body":{"item_id":18}}


_____________________________________________________________________________________________
api/DeleteItem
//Request
{
"item_id":4
}

//Response
{
    "status": 0,
    "message": "<fail message>",
    "body": null
}

or

{
    "status": 1,
    "message": "item deleted!",
    "body": {
        "item_id": 4
    }
}_____________________________________________________________________________________________
api/UpdateItem
//Request
{
	"item_id":567,
	"user_id":2
	"latitude":45.8990,
	"longtitude":-97.456,
	"title":"Egemen's coffe",
	"description":"drink it responsibly",
	"price":54.678,
	"category_id":7878,
	"trade":1
}

//Response
{"status":0,"message":"failed to insert!","body":null}

or

{"status":1,"message":"new item inserted!","body":{"item_id":18}}
_____________________________________________________________________________________________
api/GetItem
//Request
{
	"item_id":3
}

_____________________________________________________________________________________________
api/NewPicture
//Request
/*
{
	"item_id":456,
	"picture":"<base64>",
	"is_it_main":0
}

//Response
{
    "status": 0,
    "message": "failed to insert!",
    "body": null
}

or

{
    "status": 1,
    "message": "new picture inserted!",
    "body": {
        "item_pictures_id": 3
    }
}_____________________________________________________________________________________________
api/SetMainPicture
//Request
{
"item_pictures_id":4
}

//Response
{
    "status": 0,
    "message": "<fail message>",
    "body": null
}

or

{
    "status": 1,
    "message": "main picture set!",
    "body": {
        "item_pictures_id": 4
    }
}____________________________________________________________________________________________
api/DeletePicture
//Request
{
"item_pictures_id":4
}

//Response
/*
{
    "status": 0,
    "message": "<fail message>",
    "body": null
}

or

{
    "status": 1,
    "message": "main picture deleted!",
    "body": {
        "item_pictures_id": 4
    }
}
_____________________________________________________________________________________________
api/LikeItem
//Request
{
	"item_id":14,
	"user_id":2
}
_____________________________________________________________________________________________
api/UnlikeItem
//Request
{
	"items_liked_id":2
}
_____________________________________________________________________________________________
api/GetItem
//Request
{
	"item_id":3
}
_____________________________________________________________________________________________
api/FollowProfile
//Request
{
	"follower":1,
	"followed":2
}
_____________________________________________________________________________________________
api/UnfollowProfile
//Request
{
	"profile_follows_id":10
}
_____________________________________________________________________________________________
api/GetFollowers
//Request
	{
		"followed":2
	}
_____________________________________________________________________________________________
api/GetFolloweds
//Request
	{
		"follower":2
	}
_________________________________________________________________________________________
api/NewUser
//Request
{
	"username":"maho",
	"password":"fsd12321",
	"email":"email@email.com",
	"picture":""
}
____________________________________________________________________________________________
api/UpdateUser
//Request
{
	"user_id":5,
	"username":"maho",
	"password":"fsd12321",
	"email":"email@email.com",
	"picture":""
}
_____________________________________________________________________________________________
api/GetUser
//Request
{
	"user_id":2
}
_____________________________________________________________________________________________
api/Login
//Request
{
	"username":"egemen",
	"password":"12344"
}
