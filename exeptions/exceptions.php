<?php

	require_once "interfaces.php";

	class FileNotFoundException extends Exception implements IFileException {}

	class SocketException extends Exception implements INetException {}

	class WrongPassException extends Exception implements IUserlException {}

	class NetPrinterWriteException extends Exception implements IFileException, INetException {}

	class SqlConnectException extends Exception implements IInternalException, IUserlException {}

?>