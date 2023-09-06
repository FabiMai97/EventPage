<?php

use Latte\Runtime as LR;

/** source: /home/fabianmaiwald/PhpstormProjects/EventPage/templates/index.latte */
final class Template85dcc93bd2 extends Latte\Runtime\Template
{
	public const Source = '/home/fabianmaiwald/PhpstormProjects/EventPage/templates/index.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['dol' => '58', 'registration' => '68'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		if (isset($userName)) /* line 2 */ {
			echo '        <label> Wilkommen ';
			echo LR\Filters::escapeHtmlText($userName) /* line 3 */;
			echo '</label>
        <form action="/index.php" method="post">
            <div>
                <input type="submit" name="logout" value="Abmelden">
            </div>
        </form>
';
		} else /* line 9 */ {
			echo '        <a href="http://localhost:8000/login.php">
            <button> Anmeldung</button>
            <br><br>
        </a>
';
		}
		echo '
    <form action="/index.php" method="post">
        <div>
            <label> Name:
                <input type="text" name="name"
                       value="';
		if (isset($name)) /* line 20 */ {
			echo LR\Filters::escapeHtmlAttr($name) /* line 20 */;
		}
		echo '">
';
		ob_start(fn() => '') /* line 21 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Error: Der Eventname muss mehr als 3 Zeichen haben!';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['name'])) /* line 21 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label> Datum:
                <input type="date" name="date"
                       value="';
		if (isset($date)) /* line 28 */ {
			echo LR\Filters::escapeHtmlAttr($date) /* line 28 */;
		}
		echo '">
';
		ob_start(fn() => '') /* line 29 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Error: Das Datum muss in der Zukunft liegen!';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['date'])) /* line 29 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label>Beschreibung:
                <textarea type="text" name="description" rows="5"
                          cols="50">';
		if (isset($description)) /* line 36 */ {
			echo LR\Filters::escapeHtmlText($description) /* line 36 */;
		}
		echo '</textarea>
';
		ob_start(fn() => '') /* line 37 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Error: Die Eventbeschreibung muss mehr als 5 Zeichen haben!';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['description'])) /* line 37 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label> Maximale Anzahl Personen:
                <input type="number" name="max"
                       value="';
		if (isset($max)) /* line 44 */ {
			echo LR\Filters::escapeHtmlAttr($max) /* line 44 */;
		}
		echo '">
';
		ob_start(fn() => '') /* line 45 */;
		try {
			echo '                <span
                        style="color:#ff4500"> Error: Maximale Anzahl von Personen muss mindestens 1 sein!';

		} finally {
			$ʟ_ifA = ob_get_clean();
		}
		if (isset($error['max'])) /* line 45 */ {
			echo $ʟ_ifA;
		}
		echo '
            </label>
        </div>
        <div>
            <label>
                <input type="submit" name="submit" value="Submit"><br><br>
            </label>
        </div>
    </form>

    <h2>Festival Liste:</h2>

';
		foreach ($old as $dol) /* line 58 */ {
			echo '        <span>
            Name: ';
			echo LR\Filters::escapeHtmlText($dol['name']) /* line 60 */;
			echo ' <br>
            Datum: ';
			echo LR\Filters::escapeHtmlText($dol['date']) /* line 61 */;
			echo ' <br>
            Beschreibung: ';
			echo LR\Filters::escapeHtmlText($dol['description']) /* line 62 */;
			echo ' <br>
            Maximale Anzahl: ';
			echo LR\Filters::escapeHtmlText($dol['max']) /* line 63 */;
			echo ' <br><br>
        </span>
';

		}

		echo '    <h2> Anmeldung</h2>

';
		foreach ($old as $registration) /* line 68 */ {
			echo '        <h4> ';
			echo LR\Filters::escapeHtmlText($registration['name']) /* line 69 */;
			echo '</h4>

';
			if ($registration['isMax'] < $registration['max']) /* line 71 */ {
				echo '            <form action="/index.php" method="POST">
                <input type="submit" name="binDabei_';
				echo LR\Filters::escapeHtmlAttr($registration['id']) /* line 73 */;
				echo '" value="Bin Dabei!"></form>
';
			}
			echo '        <span> Der Zeit angemeldet: ';
			echo LR\Filters::escapeHtmlText($registration['isMax']) /* line 75 */;
			echo ' / ';
			echo LR\Filters::escapeHtmlText($registration['max']) /* line 75 */;
			echo '<br><br></span>
';

		}
	}
}
