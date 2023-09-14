<?php

use Latte\Runtime as LR;

/** source: /home/fabianmaiwald/PhpstormProjects/EventPage/View/login.latte */
final class Template33d793165a extends Latte\Runtime\Template
{
	public const Source = '/home/fabianmaiwald/PhpstormProjects/EventPage/View/login.latte';

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

		echo '    ';
		if (isset($error)) /* line 2 */ {
			echo LR\Filters::escapeHtmlText($error) /* line 2 */;
		}
		echo '
    <form action="/index.php?page=login" method="post">
        <div>
            <label> E-Mail:
                <input type="email" name="loginMail" value="';
		if (isset($email)) /* line 6 */ {
			echo LR\Filters::escapeHtmlAttr($email) /* line 6 */;
		}
		echo '">
            </label>
        </div>
        <div>
            <label> Passwort:
                <input type="password" name="loginPassword">
            </label>
        </div>
        <div>
            <label>
                <input type="submit" name="loginSubmit" value="Log In">
            </label>
        </div>
    </form>
    <a href="http://localhost:8000/index.php?page=registrierung">
        <button> Registrieren </button>
    </a>

';
	}
}
