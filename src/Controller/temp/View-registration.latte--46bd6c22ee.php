<?php

use Latte\Runtime as LR;

/** source: /home/fabianmaiwald/PhpstormProjects/EventPage/src/Controller/../View/registration.latte */
final class Template46bd6c22ee extends Latte\Runtime\Template
{
	public const Source = '/home/fabianmaiwald/PhpstormProjects/EventPage/src/Controller/../View/registration.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '    <form action="/index.php?page=registrierung" method="post">
        <div>
            <label> Name:
                <input type="text" name="userName"
                       value="';
		if (isset($userName)) /* line 6 */ {
			echo LR\Filters::escapeHtmlAttr($userName) /* line 6 */;
		}
		echo '">
';
		ob_start(fn() => '') /* line 7 */;
		try {
			echo '                <span
                        style="color:#ff4500"> User Name to short! ';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['userName'])) /* line 7 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label> E-Mail:
                <input type="email" name="email"
                       value="';
		if (isset($email)) /* line 14 */ {
			echo LR\Filters::escapeHtmlAttr($email) /* line 14 */;
		}
		echo '">
';
		ob_start(fn() => '') /* line 15 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Mail is already in use! ';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['email'])) /* line 15 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label>Passwort:
                <input type="password" name="password" minlength="4">
';
		ob_start(fn() => '') /* line 22 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Password to short! ';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['password'])) /* line 22 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label>
                <input type="submit" name="register" value="Registrierung">
            </label>
        </div>
    </form>
    <a href="http://localhost:8000/index.php?page=login">
        <button> Log In</button>
    </a>
    ';
		if ($success) /* line 35 */ {
			echo ' <br> Registrierung erfolgreich ';
		}
		echo "\n";
	}
}
