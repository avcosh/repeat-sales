<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class ="container">

<div class="section sec-services">
	<div class="container">
		<div class="row mb-5">
			<div class="col-lg-5 mx-auto text-center" data-aos="fade-up">
			    <h1 class="heading text-primary">Сервис повторных продаж</h1>
				<h2 class="heading text-primary">от CRM-Мастерской «TSL»</h2>
				<p>Отчеты. Пакетное внедрение. Автоматизация процессов. Отраслевые решения </p>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-sm-6 col-md-6 col-lg-6" data-aos="fade-up">

				<div class="service text-center">
					<span class="bi-cash-coin"></span>
					<div>
						<h3>Настройки</h3>
						<p class="mb-4">  </p>
						<p><a href="<?= base_url(route_to('tracking.index')) ?>" class="btn btn-outline-primary py-2 px-3">Перейти</a></p>
					</div>
				</div>

			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="100">
				<div class="service text-center">
					<span class="bi-chat-text"></span>
					<div>
						<h3>Отчет</h3>
						<p class="mb-4"> </p>
						<p><a href="<?= base_url(route_to('report.index')) ?>" class="btn btn-outline-primary py-2 px-3">Перейти</a></p>
					</div>
				</div>
			</div>
			

		</div>
	</div>
</div>

</div>
<?= $this->endSection() ?>

