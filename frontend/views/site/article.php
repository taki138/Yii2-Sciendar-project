<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Article';
$this->params['breadcrumbs'][] = $this->title;
?>

	<?php
	  function translitTextToLat($str) {
	    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
	    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
	    return str_replace($rus, $lat, $str);
	  }
	?>

<h2>Наш блог</h2>

<?php foreach($articles as $articleExample): ?>

		<div class="articleExample">
			<h3><?=$articleExample->title?></h3>
			<h4><?=($articleExample->user ? $articleExample->user->username : 'Anonimus') . ' | '?>
				<span class="text-muted small"><?=date('d-m-Y H:i:s', $articleExample->created_at) ?></span>
			</h4>

			<?php if ($articleExample->preview_image != null): ?>
				<img class="img-responsive" src="/images/article/<?=$articleExample->preview_image?>" alt="<?= translitTextToLat($articleExample->description) ?>">
			<?php else: ?>
			<?php endif ?>

			<p class="text-muted small"><?=$articleExample->description?></p>
			<p><?=$articleExample->preview_text?></p>
			<a class="btn btn-info btn-xs" href="#" role="button">Читать далее</a>
			<hr>
		</div>

<?php endforeach ?>

