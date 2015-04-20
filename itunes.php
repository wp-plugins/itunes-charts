<?php
/**
 * Plugin Name: iTunes Charts
 * Plugin URI: http://wodco.com
 * Description: iTunes widget that automatically updates to reflect the latest charts
 * Author: Ollie Brown
 * Author URI: http://wodco.com
 * Version: 1.0
 */

function itunes_scripts() {
	wp_register_script( 'player', plugin_dir_url(__FILE__) . 'lib/js/player.js', array('jquery'));
	wp_enqueue_script( 'player' );

	wp_enqueue_style( 'main', plugins_url( 'lib/css/main.css', __FILE__ ) );
}

add_action('wp_enqueue_scripts', 'itunes_scripts');

class itunes_plugin extends WP_Widget {
	function itunes_plugin() {
		parent::WP_Widget(false, $name = __('iTunes', 'wp_widget_plugin') );
	}

	function form($instance) {
		if( $instance) {
			$title = esc_attr($instance['title']);
			$type = esc_attr($instance['type']);
			$limit = esc_attr($instance['limit']);
			$genre = esc_attr($instance['genre']);
			$country = esc_attr($instance['country']);
			$explicit = $instance['explicit'] ? 'true' : 'false';
		} else {
			$title = '';
			$type = '';
			$limit = '';
			$genre = '';
			$country = '';
			$explicit = '';
		} ?>
		<div class="iTunes-widget">
			<style type="text/css">.iTunes-widget{margin:10px 0}.iTunes-widget p{display:inline-block;margin:0 0 10px;width:100%}.iTunes-widget p label{display:inline-block;margin-bottom:3px;width:100%}</style>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
			</p>
			<p>
				<span style="float: left; width: 65%;">
					<label>Country</label>
					<select id="<?php echo $this->get_field_id('country'); ?>" name="<?php echo $this->get_field_name('country'); ?>" class="widefat"> 
						<option <?php selected( $instance['country'], 'ai'); ?> value="ai">Anguilla</option>
						<option <?php selected( $instance['country'], 'ag'); ?> value="ag">Antigua and Barbuda</option>
						<option <?php selected( $instance['country'], 'ar'); ?> value="ar">Argentina</option>
						<option <?php selected( $instance['country'], 'ar_en'); ?> value="ar_en">Argentina (English)</option>
						<option <?php selected( $instance['country'], 'am'); ?> value="am">Armenia</option>
						<option <?php selected( $instance['country'], 'au'); ?> value="au">Australia</option>
						<option <?php selected( $instance['country'], 'at'); ?> value="at">Austria</option>
						<option <?php selected( $instance['country'], 'at_en'); ?> value="at_en">Austria (English)</option>
						<option <?php selected( $instance['country'], 'az'); ?> value="az">Azerbaijan</option>
						<option <?php selected( $instance['country'], 'bs'); ?> value="bs">Bahamas</option>
						<option <?php selected( $instance['country'], 'bh'); ?> value="bh">Bahrain</option>
						<option <?php selected( $instance['country'], 'bb'); ?> value="bb">Barbados</option>
						<option <?php selected( $instance['country'], 'by'); ?> value="by">Belarus</option>
						<option <?php selected( $instance['country'], 'be'); ?> value="be">Belgium</option>
						<option <?php selected( $instance['country'], 'be_en'); ?> value="be_en">Belgium (English)</option>
						<option <?php selected( $instance['country'], 'be_fr'); ?> value="be_fr">Belgium (French)</option>
						<option <?php selected( $instance['country'], 'bz'); ?> value="bz">Belize</option>
						<option <?php selected( $instance['country'], 'bz_es'); ?> value="bz_es">Belize (Spanish)</option>
						<option <?php selected( $instance['country'], 'bm'); ?> value="bm">Bermuda</option>
						<option <?php selected( $instance['country'], 'bo'); ?> value="bo">Bolivia</option>
						<option <?php selected( $instance['country'], 'bo_en'); ?> value="bo_en">Bolivia (English)</option>
						<option <?php selected( $instance['country'], 'bw'); ?> value="bw">Botswana</option>
						<option <?php selected( $instance['country'], 'br'); ?> value="br">Brazil</option>
						<option <?php selected( $instance['country'], 'br_en'); ?> value="br_en">Brazil (English)</option>
						<option <?php selected( $instance['country'], 'bn'); ?> value="bn">Brunei Darussalam</option>
						<option <?php selected( $instance['country'], 'bg'); ?> value="bg">Bulgaria</option>
						<option <?php selected( $instance['country'], 'bf'); ?> value="bf">Burkina Faso</option>
						<option <?php selected( $instance['country'], 'kh'); ?> value="kh">Cambodia</option>
						<option <?php selected( $instance['country'], 'ca'); ?> value="ca">Canada</option>
						<option <?php selected( $instance['country'], 'ca'); ?> value="ca">Canada (French)</option>
						<option <?php selected( $instance['country'], 'cv'); ?> value="cv">Cape Verde</option>
						<option <?php selected( $instance['country'], 'ky'); ?> value="ky">Cayman Islands</option>
						<option <?php selected( $instance['country'], 'cl'); ?> value="cl">Chile</option>
						<option <?php selected( $instance['country'], 'el_en'); ?> value="cl_en">Chile (English)</option>
						<option <?php selected( $instance['country'], 'cn_en'); ?> value="cn_en">China (English)</option>
						<option <?php selected( $instance['country'], 'co'); ?> value="co">Colombia</option>
						<option <?php selected( $instance['country'], 'co_en'); ?> value="co_en">Colombia (English)</option>
						<option <?php selected( $instance['country'], 'cr'); ?> value="cr">Costa Rica</option>
						<option <?php selected( $instance['country'], 'cr_en'); ?> value="cr_en"> Costa Rica (English)</option>
						<option <?php selected( $instance['country'], 'hr'); ?> value="hr">Croatia</option>
						<option <?php selected( $instance['country'], 'cy'); ?> value="cy">Cyprus</option>
						<option <?php selected( $instance['country'], 'cz'); ?> value="cz">Czech Republic</option>
						<option <?php selected( $instance['country'], 'dk'); ?> value="dk">Denmark</option>
						<option <?php selected( $instance['country'], 'dk_en'); ?> value="dk_en">Denmark (English)</option>
						<option <?php selected( $instance['country'], 'dm'); ?> value="dm">Dominica</option>
						<option <?php selected( $instance['country'], 'dm_en'); ?> value="dm_en">Dominica (English)</option>
						<option <?php selected( $instance['country'], 'do'); ?> value="do">Dominican Republic</option>
						<option <?php selected( $instance['country'], 'do_en'); ?> value="do_en">Dominican Republic (English)</option>
						<option <?php selected( $instance['country'], 'ec'); ?> value="ec">Ecuador</option>
						<option <?php selected( $instance['country'], 'ec_en'); ?> value="ec_en">Ecuador (English)</option>
						<option <?php selected( $instance['country'], 'eg'); ?> value="eg">Egypt</option>
						<option <?php selected( $instance['country'], 'sv'); ?> value="sv">El Salvador</option>
						<option <?php selected( $instance['country'], 'sv_en'); ?> value="sv_en">El Salvador (English)</option>
						<option <?php selected( $instance['country'], 'ee'); ?> value="ee">Estonia</option>
						<option <?php selected( $instance['country'], 'fj'); ?> value="fj">Fiji</option>
						<option <?php selected( $instance['country'], 'fi'); ?> value="fi">Finland</option>
						<option <?php selected( $instance['country'], 'fi_en'); ?> value="fi_en">Finland (English)</option>
						<option <?php selected( $instance['country'], 'fr'); ?> value="fr">France</option>
						<option <?php selected( $instance['country'], 'fr_en'); ?> value="fr_en">France (English)</option>
						<option <?php selected( $instance['country'], 'gm'); ?> value="gm">Gambia</option>
						<option <?php selected( $instance['country'], 'de'); ?> value="de">Germany</option>
						<option <?php selected( $instance['country'], 'de_en'); ?> value="de_en">Germany (English)</option>
						<option <?php selected( $instance['country'], 'dh'); ?> value="dh">Ghana</option>
						<option <?php selected( $instance['country'], 'gr'); ?> value="gr">Greece</option>
						<option <?php selected( $instance['country'], 'gd'); ?> value="gd">Grenada</option>
						<option <?php selected( $instance['country'], 'gt'); ?> value="gt">Guatemala</option>
						<option <?php selected( $instance['country'], 'gt_en'); ?> value="gt_en">Guatemala (English)</option>
						<option <?php selected( $instance['country'], 'gw'); ?> value="gw">Guinea-Bissau</option>
						<option <?php selected( $instance['country'], 'hn'); ?> value="hn">Honduras</option>
						<option <?php selected( $instance['country'], 'hn_en'); ?> value="hn_en">Honduras (English)</option>
						<option <?php selected( $instance['country'], 'hk'); ?> value="hk">Hong Kong</option>
						<option <?php selected( $instance['country'], 'hk_en'); ?> value="hk_en">Hong Kong (English)</option>
						<option <?php selected( $instance['country'], 'hu'); ?> value="hu">Hungary</option>
						<option <?php selected( $instance['country'], 'in'); ?> value="in">India</option>
						<option <?php selected( $instance['country'], 'id'); ?> value="id">Indonesia</option>
						<option <?php selected( $instance['country'], 'id_en'); ?> value="id_en">Indonesia (English)</option>
						<option <?php selected( $instance['country'], 'ie'); ?> value="ie">Ireland</option>
						<option <?php selected( $instance['country'], 'il'); ?> value="il">Israel</option>
						<option <?php selected( $instance['country'], 'it'); ?> value="it">Italy</option>
						<option <?php selected( $instance['country'], 'it_en'); ?> value="it_en">Italy (English)</option>
						<option <?php selected( $instance['country'], 'jp'); ?> value="jp">Japan</option>
						<option <?php selected( $instance['country'], 'jp_en'); ?> value="jp_en">Japan (English)</option>
						<option <?php selected( $instance['country'], 'jo'); ?> value="jo">Jordan</option>
						<option <?php selected( $instance['country'], 'kz'); ?> value="kz">Kazakhstan</option>
						<option <?php selected( $instance['country'], 'ke'); ?> value="ke">Kenya</option>
						<option <?php selected( $instance['country'], 'kg'); ?> value="kg">Kyrgyzstan</option>
						<option <?php selected( $instance['country'], 'la'); ?> value="la">Lao, People's Democratic Republic</option>
						<option <?php selected( $instance['country'], 'lv'); ?> value="lv">Latvia</option>
						<option <?php selected( $instance['country'], 'lb'); ?> value="lb">Lebanon</option>
						<option <?php selected( $instance['country'], 'lt'); ?> value="lt">Lithuania</option>
						<option <?php selected( $instance['country'], 'lu'); ?> value="lu">Luxembourg</option>
						<option <?php selected( $instance['country'], 'lu_en'); ?> value="lu_en">Luxembourg (English)</option>
						<option <?php selected( $instance['country'], 'lu_fr'); ?> value="lu_fr">Luxembourg (French)</option>
						<option <?php selected( $instance['country'], 'mo'); ?> value="mo">Macau</option>
						<option <?php selected( $instance['country'], 'mo_en'); ?> value="mo_en">Macau (English)</option>
						<option <?php selected( $instance['country'], 'my'); ?> value="my">Malaysia</option>
						<option <?php selected( $instance['country'], 'my_en'); ?> value="my_en">Malaysia (English)</option>
						<option <?php selected( $instance['country'], 'mt'); ?> value="mt">Malta</option>
						<option <?php selected( $instance['country'], 'mu'); ?> value="mu">Mauritius</option>
						<option <?php selected( $instance['country'], 'mx'); ?> value="mx">Mexico</option>
						<option <?php selected( $instance['country'], 'mx_en'); ?> value="mx_en">Mexico</option>
						<option <?php selected( $instance['country'], 'fm'); ?> value="fm">Micronesia, Federated States of</option>
						<option <?php selected( $instance['country'], 'md'); ?> value="md">Moldova</option>
						<option <?php selected( $instance['country'], 'mn'); ?> value="mn">Mongolia</option>
						<option <?php selected( $instance['country'], 'mz'); ?> value="mz">Mozambique</option>
						<option <?php selected( $instance['country'], 'na'); ?> value="na">Namibia</option>
						<option <?php selected( $instance['country'], 'np'); ?> value="np">Nepal</option>
						<option <?php selected( $instance['country'], 'nl'); ?> value="nl">Netherlands</option>
						<option <?php selected( $instance['country'], 'nl_en'); ?> value="nl_en">Netherlands (English)</option>
						<option <?php selected( $instance['country'], 'nz'); ?> value="nz">New Zealand</option>
						<option <?php selected( $instance['country'], 'ni'); ?> value="ni">Nicaragua</option>
						<option <?php selected( $instance['country'], 'ni_en'); ?> value="ni_en">Nicaragua (English)</option>
						<option <?php selected( $instance['country'], 'ne'); ?> value="ne">Niger</option>
						<option <?php selected( $instance['country'], 'ng'); ?> value="ng">Nigeria</option>
						<option <?php selected( $instance['country'], 'no'); ?> value="no">Norway</option>
						<option <?php selected( $instance['country'], 'no_en'); ?> value="no_en">Norway (English)</option>
						<option <?php selected( $instance['country'], 'om'); ?> value="om">Oman</option>
						<option <?php selected( $instance['country'], 'pa'); ?> value="pa">Panama</option>
						<option <?php selected( $instance['country'], 'pa_en'); ?> value="pa_en">Panama (English)</option>
						<option <?php selected( $instance['country'], 'pg'); ?> value="pg">Papua New Guinea</option>
						<option <?php selected( $instance['country'], 'py'); ?> value="py">Paraguay</option>
						<option <?php selected( $instance['country'], 'py_en'); ?> value="py_en">Paraguay (English)</option>
						<option <?php selected( $instance['country'], 'pe'); ?> value="pe">Peru</option>
						<option <?php selected( $instance['country'], 'ph'); ?> value="ph">Philippines</option>
						<option <?php selected( $instance['country'], 'pl'); ?> value="pl">Poland</option>
						<option <?php selected( $instance['country'], 'pt'); ?> value="pt">Portugal</option>
						<option <?php selected( $instance['country'], 'pt_en'); ?> value="pt_en">Portugal (English)</option>
						<option <?php selected( $instance['country'], 'qa'); ?> value="qa">Qatar</option>
						<option <?php selected( $instance['country'], 'ro'); ?> value="ro">Romania</option>
						<option <?php selected( $instance['country'], 'ru'); ?> value="ru">Russia</option>
						<option <?php selected( $instance['country'], 'ru_en'); ?> value="ru_en">Russia (English)</option>
						<option <?php selected( $instance['country'], 'sa'); ?> value="sa">Saudi Arabia</option>
						<option <?php selected( $instance['country'], 'sg'); ?> value="sg">Singapore</option>
						<option <?php selected( $instance['country'], 'sg_en'); ?> value="sg_en">Singapore (English)</option>
						<option <?php selected( $instance['country'], 'sk'); ?> value="sk">Slovakia</option>
						<option <?php selected( $instance['country'], 'si'); ?> value="si">Slovenia</option>
						<option <?php selected( $instance['country'], 'za'); ?> value="za">South Africa</option>
						<option <?php selected( $instance['country'], 'es'); ?> value="es">Spain</option>
						<option <?php selected( $instance['country'], 'es_en'); ?> value="es_en">Spain (English)</option>
						<option <?php selected( $instance['country'], 'lk'); ?> value="lk">Sri Lanka</option>
						<option <?php selected( $instance['country'], 'kn'); ?> value="kn">St. Kitts and Nevis</option>
						<option <?php selected( $instance['country'], 'sz'); ?> value="sz">Swaziland</option>
						<option <?php selected( $instance['country'], 'se'); ?> value="se">Sweden</option>
						<option <?php selected( $instance['country'], 'se_en'); ?> value="se_en">Sweden (English)</option>
						<option <?php selected( $instance['country'], 'ch'); ?> value="ch">Switzerland</option>
						<option <?php selected( $instance['country'], 'ch_en'); ?> value="ch_en">Switzerland (English)</option>
						<option <?php selected( $instance['country'], 'ch_fr'); ?> value="ch_fr">Switzerland (French)</option>
						<option <?php selected( $instance['country'], 'ch_it'); ?> value="ch_it">Switzerland (Italian)</option>
						<option <?php selected( $instance['country'], 'tw'); ?> value="tw">Taiwan</option>
						<option <?php selected( $instance['country'], 'tw_en'); ?> value="tw_en">Taiwan (English)</option>
						<option <?php selected( $instance['country'], 'tj'); ?> value="tj">Tajikistan</option>
						<option <?php selected( $instance['country'], 'th'); ?> value="th">Thailand</option>
						<option <?php selected( $instance['country'], 'th_en'); ?> value="th_en">Thailand (English)</option>
						<option <?php selected( $instance['country'], 'tt'); ?> value="tt">Trinidad and Tobago</option>
						<option <?php selected( $instance['country'], 'tr'); ?> value="tr">Turkey</option>
						<option <?php selected( $instance['country'], 'tr_en'); ?> value="tr_en">Turkey (English)</option>
						<option <?php selected( $instance['country'], 'tm'); ?> value="tm">Turkmenistan</option>
						<option <?php selected( $instance['country'], 'ug'); ?> value="ug">Uganda</option>
						<option <?php selected( $instance['country'], 'ua'); ?> value="ua">Ukraine</option>
						<option <?php selected( $instance['country'], 'ae'); ?> value="ae">United Arab Emirates</option>
						<option <?php selected( $instance['country'], 'gb'); ?> value="gb">United Kingdom</option>
						<option <?php selected( $instance['country'], 'us_es'); ?> value="us_es">United States (Spanish)</option>
						<option <?php selected( $instance['country'], 'us'); ?> value="us">USA</option>
						<option <?php selected( $instance['country'], 'uz'); ?> value="uz">Uzbekistan</option>
						<option <?php selected( $instance['country'], 've'); ?> value="ve">Venezuela</option>
						<option <?php selected( $instance['country'], 've_en'); ?> value="ve_en">Venezuela (English)</option>
						<option <?php selected( $instance['country'], 'vn'); ?> value="vn">Vietnam</option>
						<option <?php selected( $instance['country'], 'vn_en'); ?> value="vn_en">Vietnam (English)</option>
						<option <?php selected( $instance['country'], 'vg'); ?> value="vg">Virgin Islands, British</option>
						<option <?php selected( $instance['country'], 'zw'); ?> value="zw">Zimbabwe</option>
					</select>
				</span>
				<span style="float: right; width: 30%;">
					<label>Type</label>
					<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat"> 
						<option <?php selected( $instance['type'], 'topsongs'); ?> value="topsongs">Songs</option>
						<option <?php selected( $instance['type'], 'topalbums'); ?> value="topalbums">Albums</option> 
					</select>
				</span>
			</p>
			<p>
				<span style="float: left; width: 65%;">
					<label>Genre</label>
					<select id="<?php echo $this->get_field_id('genre'); ?>" name="<?php echo $this->get_field_name('genre'); ?>" class="widefat"> 
						<option <?php selected( $instance['genre'], 'all'); ?> value="">All</option>
						<option <?php selected( $instance['genre'], '20'); ?> value="20">Alternative</option>
						<option <?php selected( $instance['genre'], '29'); ?> value="29">Anime</option>
						<option <?php selected( $instance['genre'], '2'); ?> value="2">Blues</option>
						<option <?php selected( $instance['genre'], '1122'); ?> value="1122">Brazilian</option>
						<option <?php selected( $instance['genre'], '4'); ?> value="4">Children’s Music</option>
						<option <?php selected( $instance['genre'], '1232'); ?> value="1232">Chinese</option>
						<option <?php selected( $instance['genre'], '5'); ?> value="5">Classical</option>
						<option <?php selected( $instance['genre'], '3'); ?> value="3">Comedy</option>
						<option <?php selected( $instance['genre'], '6'); ?> value="6">Country</option>
						<option <?php selected( $instance['genre'], '17'); ?> value="17">Dance</option>
						<option <?php selected( $instance['genre'], '50000063'); ?> value="50000063">Disney</option>
						<option <?php selected( $instance['genre'], '25'); ?> value="25">Easy Listening</option>
						<option <?php selected( $instance['genre'], '7'); ?> value="7">Electronic</option>
						<option <?php selected( $instance['genre'], '28'); ?> value="28">Enka</option>
						<option <?php selected( $instance['genre'], '50'); ?> value="50">Fitness &amp; Workout</option>
						<option <?php selected( $instance['genre'], '50000064'); ?> value="50000064">French Pop</option>
						<option <?php selected( $instance['genre'], '50000068'); ?> value="50000068">German Folk</option>
						<option <?php selected( $instance['genre'], '50000066'); ?> value="50000066">German Pop</option>
						<option <?php selected( $instance['genre'], '18'); ?> value="18">Hip-Hop/Rap</option>
						<option <?php selected( $instance['genre'], '8'); ?> value="8">Holiday</option>
						<option <?php selected( $instance['genre'], '1262'); ?> value="1262">Indian</option>
						<option <?php selected( $instance['genre'], '53'); ?> value="53">Instrumental</option>
						<option <?php selected( $instance['genre'], '27'); ?> value="27">J-Pop</option>
						<option <?php selected( $instance['genre'], '11'); ?> value="11">Jazz</option>
						<option <?php selected( $instance['genre'], '51'); ?> value="51">K-Pop</option>
						<option <?php selected( $instance['genre'], '52'); ?> value="52">Karaoke</option>
						<option <?php selected( $instance['genre'], '30'); ?> value="30">Kayokyoku</option>
						<option <?php selected( $instance['genre'], '1243'); ?> value="1243">Korean</option>
						<option <?php selected( $instance['genre'], '12'); ?> value="12">Latino</option>
						<option <?php selected( $instance['genre'], '13'); ?> value="13">New Age</option>
						<option <?php selected( $instance['genre'], '9'); ?> value="9">Opera</option>
						<option <?php selected( $instance['genre'], '14'); ?> value="14">Pop</option>
						<option <?php selected( $instance['genre'], '15'); ?> value="15">R&amp;B/Soul</option>
						<option <?php selected( $instance['genre'], '24'); ?> value="24">Reggae</option>
						<option <?php selected( $instance['genre'], '22'); ?> value="22">Religious</option>
						<option <?php selected( $instance['genre'], '21'); ?> value="21">Rock</option>
						<option <?php selected( $instance['genre'], '10'); ?> value="10">Singer/Songwriter</option>
						<option <?php selected( $instance['genre'], '16'); ?> value="16">Soundtrack</option>
						<option <?php selected( $instance['genre'], '50000061'); ?> value="50000061">Spoken Word</option>
						<option <?php selected( $instance['genre'], '23'); ?> value="23">Vocal</option>
						<option <?php selected( $instance['genre'], '19'); ?> value="19">World</option>
					</select>
				</span>
				<span style="float: right; width: 30%;">
					<label>Size</label>
					<input id="<?php echo $this->get_field_id('limit'); ?>" class="widefat" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>">
				</span>
			</p>
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['explicit'], 'on'); ?> id="<?php echo $this->get_field_id('explicit'); ?>" name="<?php echo $this->get_field_name('explicit'); ?>"> Explicit Content
			</p>
		</div>
	<?php }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['genre'] = strip_tags($new_instance['genre']);
		$instance['country'] = strip_tags($new_instance['country']);
		$instance['explicit'] = strip_tags($new_instance['explicit']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$type = $instance['type'];
		$limit = $instance['limit'];
		$genre = $instance['genre'];
		$country = $instance['country'];
		$explicit = $instance['explicit'];
		echo $before_widget; ?>

		<div class="iTunes-widget">
			<?php if ( $title ) { echo $before_title . $title . $after_title; } ?>

			<script>
				jQuery(function($) {
					$.ajax({
						type: "GET",
						url: "https://itunes.apple.com/<?php echo $country ?>/rss/<?php echo $type ?>/limit=<?php echo $limit ?>/<?php echo 'genre='; echo $genre; echo '/'; ?>explicit=<?php if ('on' == $instance['explicit']) { ?>true<?php } else { ?>false<?php } ?>/xml",
						dataType: "xml",
						success: function(xml) {
							$(".loading").html("").hide();
							$(xml).find('entry').each(function() {
								var img = $(this).find("image[height=170]").first().text();
								var title = $(this).find('name').first().text().substring(0,35);
								var artist = $(this).find('artist').first().text().substring(0,30);
								var link = $(this).find('id').first().text();
								var m4a = $(this).find('link[title=Preview]').first().attr('href');
								var id = $(this).find('id').first().attr('im:id');
								var settings = {};
								var html = '<li class="' + id + '"><div class="artwork-wrapper"><audio class="player' + id + '" src="' + m4a + '"></audio><img src="' + img + '" class="artwork"></div><a href="' + link + '" target="_blank"><p class="title">' + title + '</p><p class="artist">' + artist + '</p></a></li>';
								$("ul.chartList").append($(html));
								$(".player"+id+"").player(settings);
							});
						}
					});
				});
			</script>

			<ul class="chartList cf">
				<div class="loading"></div>
			</ul>
		</div>

		<?php
		echo $after_widget;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("itunes_plugin");'));

?>