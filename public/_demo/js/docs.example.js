Gumby.ready(function() {

	var $lastContent = $('#docs-content > div:last-child'),
		sideBarHeight = $('#sidebar-nav-holder').height();
	if($lastContent.height() < sideBarHeight) {
		$lastContent.css('height', sideBarHeight);
	}

	if($(window).width() > 767) {

		var scrollTop = $(window).scrollTop(),
			url = window.location.href,
			hash = window.location.hash,
			historySupport = !!history.pushState,
			delay = 0,
			currentNav = '';

		// ensure url ends in '/' for hash bangs
                /*
		if(!hash && url.substr(url.length - 1, url.length) !== '/') {
			window.location.href = window.location.href + '/';
		}
                */

		// hash bang on load?
                //TODO:ハッシュが現在対象にしているリンク先に存在していたら、gumby.skipの方がいい。
		if(hash.length > 3) {
			var type = hash.substr(3, hash.length - 3);
			$(window).load(function() {
				setTimeout(function() {
                                    //XSS?
                                    //fixed in jQuery1.7? http://subtech.g.hatena.ne.jp/mala/20110624/1308881526
					$('#sidebar-nav .skip[href="#'+type+'"]').trigger('gumby.skip');
				}, 200);
			});
		}

		// update hash and push new history state on click of sidebar nav
		$('#sidebar-nav .skip').on('gumby.onComplete', function() {

			var href = $(this).attr('href');
			currentNav = href;

			window.location.hash = '#!/'+href.substr(1, href.length - 1);
		});

//history.back
		$(window).on('popstate', function(e, another) {

			var hash = window.location.hash;

			if(!hash) {
				return false;
			}

			hash = hash.replace('#!/', '');
			var $link = $('.skip[href="'+hash+'"]');

			if(currentNav && currentNav !== hash && hash.length > 2 && $link.length) {
				$link.trigger('gumby.skip');
			}
		}).scroll(function() {

			var scrollOffset = $(this).scrollTop(),
				$targets = $('#docs-content [data-target]'),
				length = $targets.length,
				i = 0,
				distance = 0,
				$closest;

			if(!scrollOffset) {
                                //戻す必要ある？
				window.location.hash = '#!/';
				clearTimeout(delay);
				return;
			}

			// loop round sub nav links and find closest to top of page
			for(i; i < length; i++) {
				var $target = $($targets[i]),
					targetOffset = $target.offset().top - 100;// add mergin

				if(!distance || targetOffset - scrollOffset < 20 && targetOffset > distance) {
					distance = targetOffset;
					$closest = $target;
				}
			}

			var $activeLink = $('#sidebar-nav .skip[gumby-goto="[data-target=\''+$closest.attr('data-target')+'\']"]');

			// update nav active class
			$('#sidebar-nav li').removeClass('active');
			$activeLink.parent().addClass('active');

			// update hash on 'scroll end'
			clearTimeout(delay);
			delay = setTimeout(function() {
				var href = $activeLink.attr('href');
				currentNav = href;
				window.location.hash = '#!/'+href.substr(1, href.length - 1);
			}, 200);
		});

		$('#sidebar-nav-holder.vertical-nav').on('gumby.onFixed', function() {
			var $this = $(this),
				html = '<li id="gumby-back-to-top">\
							<a href="#" class="skip" gumby-goto="top" gumby-duration="600">\
								<i class="icon icon-up-open"></i> Back to top\
							</a>\
						</li>';

			if(!$this.find('#gumby-back-to-top').length) {
				$this.find('ul').append(html);
			}

			Gumby.initialize('skiplink');

		}).on('gumby.onUnfixed', function() {
			//$(this).find('ul li:first-child').remove();
                        $("#gumby-back-to-top").remove();
		});
	}
});
