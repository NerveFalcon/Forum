<section class="themes">
<!-- <div>
	<h2><a href="/theme/1"><fromphp>Правила форума</fromphp></a></h2>
	<p>Кратко о теме</p>
	<a href="/theme/1">Подробнее</a>
</div> -->
<?php foreach ($params[0] as $themeList => $value): 
	// if($value['id'] == 1) continue; ?>
<div class="theme">
	<h2><a href="/theme/<?php echo $value['id'];?>"><fromphp><?php echo $value['title'];?></fromphp></a></h2>
	<p><fromphp><?php echo $value['desc']; ?></fromphp></p>
	<a href="/theme/<?php echo $value['id'];?>">Подробнее</a>
</div>
<?php endforeach;?>
<div class="pg-btn flex-container-row flex-center">
<?php for ($i=0; $i < $params[1]; $i++):?>
<a href="/themes/<?php echo $i+1;?>" class="flex-item-row"><fromphp><?php echo $i+1;?></fromphp></a>
<?php endfor;?>
</div>
</section>
<!-- 1 ... [5|96] ... 100 -->
<!-- 1 2 3 ... 100 -->
<!-- 1... 98 99 100 -->
<!-- < ?php 
for ($i=0; $i < $params[1]; $i++)
{
	if($params[1] > 7)
	{
		if($params[2] < 3)
		{
			if($i > 3)
			{
				if($i = $params[1] - 1)
					echo " ... ".($i+1);
				continue;
			}
			echo ($i+1)." ";
		}
		else if(($params[2] > 3) && ($params[2] < $params[1] - 3))
		{
			echo ($i+1)." ";
			if($i != $params[2])
			{
				continue;
			}
			else
			{
				echo " ... ". ($i+1) ." ... ";
				continue;
			}
		}
		else if($params[2] > $params[1])
		{
		}
	}
	else
	{
		echo ($i+1)." ";
	}
}
?> -->
