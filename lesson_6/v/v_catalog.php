<main>
	<?php
		if (isset($catalog)) {
			foreach ($catalog as $product) {
				echo '<div class="goods"><a href="index.php?c=page&act=product&id=' . $product["id"] . '"><img class="goods__img" src="'. $product["image"] . '" alt="Изображение" title="'. $product["title"] . '"></a>
				<span>'. $product["title"] . '</span></div>';
			}
		}
	?>
</main>