<?php

	interface IException {}

		interface IInternalException extends IException {}

		interface IFileException extends IException {}

			interface INetException extends IInternalException {}

		interface IUserlException extends IException {}

?>