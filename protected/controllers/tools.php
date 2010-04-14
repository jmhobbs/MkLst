<?php
	require_once( dirname( __FILE__ ) . '/application.php' );
	require_once( APP_ROOT . '/vendor/SwiftMailer/swift_required.php' );

	class Tools_Controller extends Application_Controller {

		function recover () {
			
			$this->view->content = new View( 'tools/recover' );
			
			if( $_POST ) {
				if( empty( $_POST['email'] ) )
					return $this->view->flash = 'Your e-mail is required!';
				
				$lists = new Alist_Collection();
				$sql = 'SELECT * FROM alist WHERE email LIKE "' . $lists->getDb()->escape( $_POST['email'] ) . '" ORDER BY name DESC';
				$lists->loadBySql( $sql );
				
				if( $lists->isEmpty() )
					return $this->view->flash = 'No lists found for ' . $_POST['email'];

					$body = <<<EOF
== List Recovery From MkLst.com ==

Someone (hopefully you) requested a list of all your MkLst.com lists be sent to
this address.  If this was you, well, here you go.  If it wasn't, sorry! Please 
ignore this message or contact us at http://mklst.com/

== Your Lists ==


EOF;
				
				foreach( $lists as $list )
					$body .= $list->getName() . "\r\n  - " . uri::full_path( 'list/view/' . $list->getId() ) . "\r\n\r\n";
					
				$message = Swift_Message::newInstance();
				$message->setSubject( 'MkLst.com List Recovery' );
				$message->setFrom( array( 'no-reply@mklst.com' => 'No Reply' ) );
				$message->setTo( array( $_POST['email'] ) );
				$message->setBody( $body );

				Swift_Mailer::newInstance( Swift_MailTransport::newInstance() )->send( $message );

				$this->view->flash = 'Recovery list sent!';
			}
			
		}

	}