<li class=" dropdown">
	<a href="#" class="dropdown-toggle introduct disabled" data-toggle="dropdown">Hiệp hội VSA</a>
	<ul class="sub-menu dropdown-menu">
		<li class="dropdown"><a hreft="#" class="dropdown-toggle disabled" data-toggle="dropdown" aria-expanded="">@lang('general.association')</a>
			<ul class="sub-menu dropdown-menu menu-2">
				<li><a href="#">@lang('general.rule')</a></li>
				<li><a href="#">@lang('general.history')</a></li>
				<li><a href="#">@lang('executive_board')</a></li>
				<li><a href="#">@lang('association')</a></li>
			</ul>
		</li>
		<li><a href="#">@lang('general.training')</a></li>
		<li><a href="#">@lang('general.active_program')</a></li>
		<li><a href="#">@lang('general.magazine')</a></li>
	</ul>
</li>
<li class=" dropdown">
	<a href="{{ route('homepage.index') }}" class="dropdown-toggle introduct disabled" data-toggle="dropdown">@lang('general.member')</a>
	<ul class="sub-menu dropdown-menu">
		<li class="dropdown"><a hreft="#" class="dropdown-toggle disabled" data-toggle="dropdown" aria-expanded="#">@lang('general.official_member')</a>
			<ul class="sub-menu dropdown-menu menu-2">
				<li>
					<a href="{{ route('member.personal') }}">@lang('general.personal_member')</a>
				</li>
				<li>
					<a href="{{ route('member.association') }}">@lang('general.association_member')</a>
				</li>
			</ul>
		</li>
		<li><a href="">@lang('general.affiliated_member')</a></li>
	</ul>
</li>

<?php foreach ($categories as $value): ?>
	@if (count($value->children) == 0)
	<li><a href="{{ route('news.getNewsFromCategory',['category_slug'=>$value->title_slug]) }}" class="home">{{ $value->title }}</a></li>
	@else
	<li class=" dropdown"><a href="#" class="dropdown-toggle introduct disabled" data-toggle="dropdown">{{ $value->title }}</a>
		<ul class="sub-menu dropdown-menu">
			<?php foreach ($value->children as $child1): ?>
				@if ($child1->status == 1)
				@if (count($child1->children) == 0)
				<li><a href="{{ route('news.getNewsFromCategory',['category_slug'=>$child1->title_slug]) }}">{{ $child1->title }}</a></li>
				@else
				<li class="dropdown"><a hreft="#" class="dropdown-toggle disabled" data-toggle="dropdown" aria-expanded="">{{ $child1->title }}</a>
					<ul class="sub-menu dropdown-menu menu-2">
						<?php foreach ($child1->children as $child2): ?>
							@if ($child2->status == 1)
							<li><a href="{{ route('news.getNewsFromCategory',['category_slug'=>$child2->title_slug]) }}">{{ $child2->title }}</a></li>
							@endif
						<?php endforeach ?><!-- End level3 -->
					</ul>
				</li>
				@endif
				@endif
			<?php endforeach ?><!-- End level2 -->
		</ul>
	</li>
	@endif
<?php endforeach ?><!-- End level1 -->
<li><a href="">@lang('general.partner')</a></li>
<li><a href="{{ route('contact') }}">@lang('general.contact')</a></li>