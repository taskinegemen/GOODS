<?php

class ApiController extends Controller
{
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$parameters=Yii::$app->request->post('parameters');
		$parameters_array=CJSON::encode(base64_decode($parameters));

		print_r($parameters);
		REST::sendResponse(200,CJSON::encode(array('status'=>'false','message'=>'you are not authroized to see this content!')));

	}



//Request
/*{
	"latitude":45.8990,
	"user_id":2,
	"longtitude":-97.456,
	"title":"Egemen's coffe",
	"description":"drink it responsibly",
	"price":54.678,
	"category_id":7878,
	"trade":1
}*/


//Response
/*
{"status":0,"message":"failed to insert!","body":null}

or

{"status":1,"message":"new item inserted!","body":{"item_id":18}}
*/
	public function actionNewItem(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$latitude=$parameters_array["latitude"];
		$longtitude=$parameters_array["longtitude"];
		$title=$parameters_array["title"];
		$description=$parameters_array["description"];
		$price=$parameters_array["price"];
		$category_id=$parameters_array["category_id"];
		$trade=$parameters_array["trade"];
		$user_id=$parameters_array["user_id"];

		$is_category_available=Category::model()->find('category_id=:category_id',array(':category_id'=>$category_id));
		if($is_category_available)
		{

			$is_user_available=User::model()->find('user_id=:user_id',array(':user_id'=>$user_id));
			if($is_user_available)
			{
				$item=new Item();
				$item->latitude=$latitude;
				$item->longtitude=$longtitude;
				$item->title=$title;
				$item->description=$description;
				$item->price=$price;
				$item->category_id=$category_id;
				$item->trade=$trade;
				if($item->save())
				{
					REST::sendResponse(200,CJSON::encode(
							array(
									'status'=>1,
								  	'message'=>'new item inserted!',
								  	'body'=>array('item_id'=>((int)$item->item_id))
								  )
						));

				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to insert!','body'=>$item->getErrors()
						)));
				}
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!!','body'=>$is_user_available
					)));				
			}

		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'category is not available!','body'=>$is_category_available
					)));
		}

	}



//Request
/*{
	"item_id":567,
	"user_id":2
	"latitude":45.8990,
	"longtitude":-97.456,
	"title":"Egemen's coffe",
	"description":"drink it responsibly",
	"price":54.678,
	"category_id":7878,
	"trade":1
}*/


//Response
/*
{"status":0,"message":"failed to insert!","body":null}

or

{"status":1,"message":"new item inserted!","body":{"item_id":18}}
*/
	public function actionUpdateItem(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		$item_id=$parameters_array["item_id"];		
		$latitude=$parameters_array["latitude"];
		$longtitude=$parameters_array["longtitude"];
		$title=$parameters_array["title"];
		$description=$parameters_array["description"];
		$price=$parameters_array["price"];
		$category_id=$parameters_array["category_id"];
		$trade=$parameters_array["trade"];
		$user_id=$parameters_array["user_id"];

		$item=Item::model()->find('item_id=:item_id',array(':item_id'=>$item_id));
		if($item)
		{

				$is_category_available=Category::model()->find('category_id=:category_id',array(':category_id'=>$category_id));
				if($is_category_available)
				{

					$is_user_available=User::model()->find('user_id=:user_id',array(':user_id'=>$user_id));
					if($is_user_available)
					{
						$item->latitude=$latitude;
						$item->longtitude=$longtitude;
						$item->title=$title;
						$item->description=$description;
						$item->price=$price;
						$item->category_id=$category_id;
						$item->trade=$trade;
						if($item->save())
						{
							REST::sendResponse(200,CJSON::encode(
									array(
											'status'=>1,
										  	'message'=>'item updated!',
										  	'body'=>array('item_id'=>((int)$item->item_id))
										  )
								));

						}
						else
						{
							REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to insert!','body'=>$item->getErrors()
								)));
						}
					}
					else
					{
						REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!!','body'=>$is_user_available
							)));				
					}

				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'category is not available!','body'=>$is_category_available
							)));
				}

		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item_id is not available!','body'=>$item
				)));
		}




	}



//Request
/*
{
	"item_id":3
}
*/
	public function actionGetItem(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		$item_id=$parameters_array["item_id"];

		$item=Item::model()->find('item_id=:item_id',array(':item_id'=>$item_id));
		if($item)
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>1,'message'=>'item successfully retrieved!','body'=>$item
					)));			
		}
		else
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item is not available!','body'=>$item
					)));			
		}

	}




//Request
/*
{
"item_id":4
}
*/

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
    "message": "item deleted!",
    "body": {
        "item_id": 4
    }
}
*/

	public function actionDeleteItem(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$item_id=$parameters_array["item_id"];
	

		$item=Item::model()->find('item_id=:item_id',array(':item_id'=>$item_id));
		if($item)
		{
			if($item->delete())
			{
				REST::sendResponse(200,CJSON::encode(
						array(
								'status'=>1,
							  	'message'=>'item deleted!',
							  	'body'=>array('item_pictures_id'=>((int)$item_id))
							  )
					));
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to delete item!','body'=>$item->getErrors()
					)));
			}
			


		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item_id is not available!','body'=>$item
					)));
		}
	}




//Request
/*
{
	"item_id":456,
	"picture":"serwerwerwerwer",
	"is_it_main":0
}
*/

//Response
/*
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
}

*/

	public function actionNewPicture(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$item_id=$parameters_array["item_id"];
		$picture=$parameters_array["picture"];
		$is_it_main=$parameters_array["is_it_main"];

		$item=Item::model()->find('item_id=:item_id',array(':item_id'=>$item_id));
		if($item)
		{
			if($is_it_main==1)
			{
				//update all to 0
				ItemPictures::model()->updateAll(array('is_it_main'=>0),'item_id='.$item_id);
			}

			$item_pictures=new ItemPictures();
			$item_pictures->item_id=$item_id;
			$item_pictures->picture=$picture;
			$item_pictures->is_it_main=$is_it_main;

			if($item_pictures->save())
			{
				REST::sendResponse(200,CJSON::encode(
						array(
								'status'=>1,
							  	'message'=>'new item inserted!',
							  	'body'=>array('item_pictures_id'=>((int)$item_pictures->item_pictures_id))
							  )
					));

			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to insert!','body'=>$item_pictures->getErrors()
					)));
			}








		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item_id is not available!','body'=>$item
					)));	
		}		

	}


//Request
/*
{
"item_pictures_id":4
}
*/

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
    "message": "main picture set!",
    "body": {
        "item_pictures_id": 4
    }
}
*/
	public function actionSetMainPicture(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$item_pictures_id=$parameters_array["item_pictures_id"];
	

		$item_pictures=ItemPictures::model()->find('item_pictures_id=:item_pictures_id',array(':item_pictures_id'=>$item_pictures_id));
		if($item_pictures)
		{
			ItemPictures::model()->updateAll(array('is_it_main'=>0),'item_id='.$item_pictures->item_id);
			$item_pictures->is_it_main=1;
			if($item_pictures->save())
			{
				REST::sendResponse(200,CJSON::encode(
						array(
								'status'=>1,
							  	'message'=>'main picture set!',
							  	'body'=>array('item_pictures_id'=>((int)$item_pictures_id))
							  )
					));
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to set main picture!','body'=>$item_pictures->getErrors()
					)));
			}
			


		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item_pictures_id is not available!','body'=>$item_pictures
					)));
		}
	}


//Request
/*
{
"item_pictures_id":4
}
*/

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
*/

	public function actionDeletePicture(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$item_pictures_id=$parameters_array["item_pictures_id"];
	

		$item_pictures=ItemPictures::model()->find('item_pictures_id=:item_pictures_id',array(':item_pictures_id'=>$item_pictures_id));
		if($item_pictures)
		{
			if($item_pictures->delete())
			{
				REST::sendResponse(200,CJSON::encode(
						array(
								'status'=>1,
							  	'message'=>'main picture deleted!',
							  	'body'=>array('item_pictures_id'=>((int)$item_pictures_id))
							  )
					));
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to delete picture!','body'=>$item_pictures->getErrors()
					)));
			}
			


		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item_pictures_id is not available!','body'=>$item_pictures
					)));
		}
	}


//Request
/*
{
	"item_id":14,
	"user_id":2
}
*/

	public function actionLikeItem(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$item_id=$parameters_array["item_id"];
		$user_id=$parameters_array["user_id"];
	
		$is_user_available=User::model()->find('user_id=:user_id',array(':user_id'=>$user_id));

		if($is_user_available)
		{
				$item=Item::model()->find('item_id=:item_id',array(':item_id'=>$item_id));
				if($item)
				{

					$items_liked=new ItemsLiked();
					$items_liked->item_id=$item_id;
					$items_liked->user_id=$user_id;
					$items_liked->read=0;
					$items_liked->date=new CDbExpression('NOW()');

					if($items_liked->save())
					{
						REST::sendResponse(200,CJSON::encode(
								array(
										'status'=>1,
									  	'message'=>'item liked!',
									  	'body'=>array('items_liked_id'=>((int)$items_liked->items_liked_id))
									  )
							));
					}
					else
					{
						REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to like item!','body'=>$items_liked->getErrors()
							)));
					}
					


				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'item is not available!','body'=>$item
							)));
				}
		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!','body'=>$is_user_available
					)));	
		}
	}


//Request
/*
{
	"items_liked_id":2
}
*/


//Request
/*

{
	"items_liked_id":7
}

*/
	public function actionUnlikeItem(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$items_liked_id=$parameters_array["items_liked_id"];
	
		$items_liked=ItemsLiked::model()->find('items_liked_id=:items_liked_id',array(':items_liked_id'=>$items_liked_id));

		if($items_liked)
		{

			if($items_liked->delete())
			{
				REST::sendResponse(200,CJSON::encode(
						array(
								'status'=>1,
							  	'message'=>'unliked!',
							  	'body'=>array('items_liked_id'=>((int)$items_liked_id))
							  )
					));
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to like item!','body'=>$items_liked->getErrors()
					)));
			}

		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'items_liked_id is not available!','body'=>$items_liked
					)));	
		}
	}

//Request
/*
{
	"follower":1,
	"followed":2
}
*/


	public function actionFollowProfile(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$follower=$parameters_array["follower"];
		$followed=$parameters_array["followed"];
	
		$follower_user=User::model()->find('user_id=:user_id',array(':user_id'=>$follower));
		$followed_user=User::model()->find('user_id=:user_id',array(':user_id'=>$followed));

		if($follower_user && $followed_user)
		{

				$profile_follows=new ProfileFollows();
				$profile_follows->follower=$follower;
				$profile_follows->followed=$followed;
				$profile_follows->read=0;
				$profile_follows->date=new CDbExpression('NOW()');
				if($profile_follows->save())
				{
						REST::sendResponse(200,CJSON::encode(
								array(
										'status'=>1,
									  	'message'=>'profile followed!',
									  	'body'=>array('profile_follows_id'=>((int)$profile_follows->profile_follows_id))
									  )
							));
				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to follow!','body'=>$profile_follows->getErrors()
							)));
				}
		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!','body'=>$is_user_available
					)));	
		}
	}

//Request
/*
{
	"profile_follows_id":10
}
*/
	public function actionUnfollowProfile(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$profile_follows_id=$parameters_array["profile_follows_id"];
		$profile_follows=ProfileFollows::model()->find('profile_follows_id=:profile_follows_id',array(':profile_follows_id'=>$profile_follows_id));

		if($profile_follows)
		{

				if($profile_follows->delete())
				{
						REST::sendResponse(200,CJSON::encode(
								array(
										'status'=>1,
									  	'message'=>'profile unfollowed!',
									  	'body'=>array('profile_follows_id'=>((int)$profile_follows_id))
									  )
							));
				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to unfollow!','body'=>$profile_follows->getErrors()
							)));
				}
		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'profile_follows_id is not available!','body'=>$profile_follows
					)));	
		}
	}

//Request
/*
	{
		"followed":2
	}
*/
public function actionGetFollowers(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$followed=$parameters_array["followed"];
		$followers=ProfileFollows::model()->findAll('followed=:followed',array(':followed'=>$followed));
		if($followers)
		{
			REST::sendResponse(200,CJSON::encode(
					array(
							'status'=>1,
						  	'message'=>'followerslisted!',
						  	'body'=>array('followers'=>$followers)
						  )
				));
		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'followed is not available!','body'=>$followers
					)));				
		}

}

/*
	{
		"followed":2
	}
*/
public function actionGetFolloweds(){

		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$follower=$parameters_array["follower"];
		$followeds=ProfileFollows::model()->findAll('follower=:follower',array(':follower'=>$follower));
		if($followeds)
		{
			REST::sendResponse(200,CJSON::encode(
					array(
							'status'=>1,
						  	'message'=>'followers listed!',
						  	'body'=>array('followed'=>$followeds)
						  )
				));
		}
		else
		{
			REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'follower is not available!','body'=>$followeds
					)));				
		}

}


//Request
/*
{
	"username":"maho",
	"password":"fsd12321",
	"email":"email@email.com",
	"picture":""
}
*/

	public function actionNewUser(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$username=$parameters_array["username"];
		$password=$parameters_array["password"];
		$email=$parameters_array["email"];
		$picture=$parameters_array["picture"];



			$is_user_available=User::model()->find('username=:username',array(':username'=>$username));
			if(!$is_user_available)
			{
				$user=new User();
				$user->username=$username;
				$user->password=$password;
				$user->email=$email;
				$user->picture=$picture;
				
				if($user->save())
				{
					REST::sendResponse(200,CJSON::encode(
							array(
									'status'=>1,
								  	'message'=>'new user inserted!',
								  	'body'=>array('user_id'=>((int)$user->user_id))
								  )
						));

				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to insert!','body'=>$user->getErrors()
						)));
				}
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is available!!','body'=>$is_user_available
					)));				
			}

		}



	public function actionUpdateUser(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		
		$user_id=$parameters_array["user_id"];
		$username=$parameters_array["username"];
		$password=$parameters_array["password"];
		$email=$parameters_array["email"];
		$picture=$parameters_array["picture"];



			$user=User::model()->find('user_id=:user_id',array(':user_id'=>$user_id));
			if($user)
			{

				$user->username=$username;
				$user->password=$password;
				$user->email=$email;
				$user->picture=$picture;
				
				if($user->save())
				{
					REST::sendResponse(200,CJSON::encode(
							array(
									'status'=>1,
								  	'message'=>'user updated!',
								  	'body'=>array('user_id'=>((int)$user->user_id))
								  )
						));

				}
				else
				{
					REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'failed to update!','body'=>$user->getErrors()
						)));
				}
			}
			else
			{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!','body'=>$user
					)));				
			}

		}


//Request
/*
{
	"user_id":2
}
*/
	public function actionGetUser(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		$username=$parameters_array["user_id"];

		$user=User::model()->find('user_id=:user_id',array(':user_id'=>$username));
		if($user)
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>1,'message'=>'user successfully retrieved!','body'=>$user
					)));			
		}
		else
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!','body'=>$user
					)));			
		}

	}


//Request
/*
{
	"username":"egemen",
	"password":"12344"
}
*/
	public function actionLogin(){

		
		$parameters=Yii::app()->request->getPost('parameters');
		$parameters_array=CJSON::decode(base64_decode($parameters));
		$username=$parameters_array["username"];
		$password=$parameters_array["password"];

		$user=User::model()->find('username=:username AND password=:password',array(':username'=>$username,':password'=>$password));
		if($user)
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>1,'message'=>'successfully logged in!','body'=>$user
					)));			
		}
		else
		{
				REST::sendResponse(200,CJSON::encode(array('status'=>0,'message'=>'user is not available!','body'=>$user
					)));			
		}

	}



	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}
