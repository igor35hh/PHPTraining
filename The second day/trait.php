<?php 

	class Base {
		public function sayHello() {
			echo 'Hello';
		}
	}

	trait SayWorld {
		public function sayHello() {
			parent::sayHello();
			echo 'World!';
		}
	}

	class MyHelloWorld extends Base {
		use SayWorld;
	}

	$o = new MyHelloWorld();
	$o->sayHello();

	//

	trait Hello {
		public function sayHello() {
			echo 'Hello ';
		}
	}

	trait World {
		public function sayWorld() {
			echo 'World ';
		}
	}

	class MyHelloWorld {
		use Hello, World;
		public function sayExclamationMark() {
			echo '!';
		}
	}

	$a = new MyHelloWorld();
	$a->sayHello();
	$a->sayWorld();
	$a->sayExclamationMark();

	//

	trait A {
	    public function smallTalk() {
	        echo 'a';
	    }
	    public function bigTalk() {
	        echo 'A';
	    }
	}

	trait B {
	    public function smallTalk() {
	        echo 'b';
	    }
	    public function bigTalk() {
	        echo 'B';
	    }
	}

	class Talker {
	    use A, B {
	        B::smallTalk insteadof A;
	        A::bigTalk insteadof B;
	    }
	}

	class Aliased_Talker {
	    use A, B {
	        B::smallTalk insteadof A;
	        A::bigTalk insteadof B;
	        B::bigTalk as talk;
	    }
	}

	//
	trait HelloWorld {
	    public function sayHello() {
	        echo 'Hello World!';
	    }
	}

	class MyClass1 {
	    use HelloWorld { sayHello as protected; }
	}

	class MyClass2 {
	    use HelloWorld { sayHello as private myPrivateHello; }
	}

?>