		</main>
		<footer>
			<div class="ColGray Tright">
				created by NerveFalcon
			</div>
		</footer>
	</div>
<?php 
if(ini_get('display_errors') == 1)
{
	echo '<pre>session: ';
	print_r($_SESSION);
	echo '<br>coockie: ';
	print_r($_COOKIE);
	echo '</pre>';
}
?>
</body>
</html>