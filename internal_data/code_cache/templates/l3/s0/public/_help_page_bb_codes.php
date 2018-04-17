<?php
// FROM HASH: bdd9426ebcc730e9cf7e7cebfa14327c
return array('macros' => array('row_output' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'title' => '!',
		'desc' => '!',
		'example' => '!',
		'anchor' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="bbCodeHelpItem block-row block-row--separated">
		<span class="u-anchorTarget" id="' . $__templater->escape($__vars['anchor']) . '"></span>
		<h3 class="block-textHeader">' . $__templater->escape($__vars['title']) . '</h3>
		<div>' . $__templater->escape($__vars['desc']) . '</div>
		' . $__templater->callMacro(null, 'example_output', array(
		'bbCode' => $__vars['example'],
	), $__vars) . '
	</li>
';
	return $__finalCompiled;
},
'example_output' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'bbCode' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="bbCodeDemoBlock">
		<dl class="bbCodeDemoBlock-item">
			<dt>' . 'Ví dụ' . $__vars['xf']['language']['label_separator'] . '</dt>
			<dd>' . $__templater->filter($__vars['bbCode'], array(array('nl2br', array()),), true) . '</dd>
		</dl>
		<dl class="bbCodeDemoBlock-item">
			<dt>' . 'Hiển thị' . $__vars['xf']['language']['label_separator'] . '</dt>
			<dd>' . $__templater->fn('bb_code', array($__vars['bbCode'], 'help', null, ), true) . '</dd>
		</dl>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('help_bb_codes.less');
	$__finalCompiled .= '

<div class="block">
	<div class="block-container">
		<ul class="listPlain block-body">

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[B], [I], [U], [S] - Bold, Italics, Underline, and Strike-through', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Làm cho vùng chữ được bôi trở thành in đậm, in nghiêng, gạch chân hoặc gạch ngang.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('This is [B]bold[/B] text.
This is [I]italic[/I] text.
This is [U]underlined[/U] text.
This is [S]struck-through[/S] text.', array(array('preEscaped', array()),), false),
		'anchor' => 'basic',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[COLOR=<span class="option">color</span>], [FONT=<span class="option">name</span>], [SIZE=<span class="option">size</span>] - Text Color, Font, and Size', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Thay đổi màu sắc, phông chữ hoặc kích thước của ký tự được chọn.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('This is [COLOR=red]red[/COLOR] and [COLOR=#0000cc]blue[/COLOR] text.
This is [FONT=Courier New]Courier New[/FONT] text.
This is [SIZE=1]small[/SIZE] and [SIZE=7]big[/SIZE] text.', array(array('preEscaped', array()),), false),
		'anchor' => 'style',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[URL], [EMAIL] - Linking', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Chèn liên kết tại Ký tự được bao quanh.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[URL]http://www.example.com[/URL]
[EMAIL]example@example.com[/EMAIL]', array(array('preEscaped', array()),), false),
		'anchor' => 'email-url',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[URL=<span class="option">link</span>], [EMAIL=<span class="option">address</span>] - Linking (Advanced)', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Chèn liên kết cho trang web hoặc địa chỉ email cho vùng chọn.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[URL=http://www.example.com]Go to example.com[/URL]
[EMAIL=example@example.com]Email me[/EMAIL]', array(array('preEscaped', array()),), false),
		'anchor' => 'email-url-advanced',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[USER=<span class="option">ID</span>] - Profile Linking', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Liên kết đến một hồ sơ . Điều này thường được chèn tự động khi gắn thẻ thành viên.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[USER=' . ($__vars['xf']['visitor']['user_id'] ? $__vars['xf']['visitor']['user_id'] : '1') . ']' . ($__vars['xf']['visitor']['user_id'] ? $__vars['xf']['visitor']['username'] : 'Tên thành viên') . '[/USER]', array(array('preEscaped', array()),), false),
		'anchor' => 'user-mention',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[IMG] - Image', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Hiển thị hình ảnh sử dụng vùng chọn như là 1 liên kết', array(array('preEscaped', array()),), false),
		'example' => '[IMG]' . $__templater->fn('base_url', array(($__templater->fn('property', array('publicMetadataLogoUrl', ), false) ?: $__templater->fn('property', array('publicLogoUrl', ), false)), true, ), false) . '[/IMG]',
		'anchor' => 'image',
	), $__vars) . '

			<li class="bbCodeHelpItem block-row block-row--separated">
				<span class="u-anchorTarget" id="media"></span>
				<h3 class="block-textHeader">' . '[MEDIA=<span class="option">site</span>] - Embedded Media' . '</h3>
				<div>
					' . 'Chèn video, flash đa phương tiện từ trang web được phép vào nội dung bài viết. Bạn nên dùng nút MEDIA ở thanh công cụ soạn thảo của diễn đàn.' . '<br />
					' . 'Trang web được chấp thuận' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->fn('media_sites', array(), true) . '
				</div>
				<div class="bbCodeDemoBlock">
					<dl class="bbCodeDemoBlock-item">
						<dt>' . 'Ví dụ' . $__vars['xf']['language']['label_separator'] . '</dt>
						<dd>[MEDIA=youtube]oHg5SJYRHA0[/MEDIA]</dd>
					</dl>
					<dl class="bbCodeDemoBlock-item">
						<dt>' . 'Hiển thị' . $__vars['xf']['language']['label_separator'] . '</dt>
						<dd><i>' . 'An embedded YouTube player would appear here.' . '</i></dd>
					</dl>
				</div>
			</li>

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[LIST] - Lists', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Hiển thị kiểu danh sách dấu chấm hoặc số.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[LIST]
[*]Bullet 1
[*]Bullet 2
[/LIST]
[LIST=1]
[*]Entry 1
[*]Entry 2
[/LIST]', array(array('preEscaped', array()),), false),
		'anchor' => 'list',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[LEFT], [CENTER], [RIGHT] - Text Alignment', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Thay đổi kiểu căn lề của vùng chữ được chọn.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[LEFT]Left-aligned[/LEFT]
[CENTER]Center-aligned[/CENTER]
[RIGHT]Right-aligned[/RIGHT]', array(array('preEscaped', array()),), false),
		'anchor' => 'align',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[QUOTE] - Quoted Text', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Hiển thị ký tự đã được trích từ nguồn khác. Bạn có thể đặt tên của nguồn.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[QUOTE]Quoted text[/QUOTE]
[QUOTE=A person]Something they said[/QUOTE]', array(array('preEscaped', array()),), false),
		'anchor' => 'quote',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[SPOILER] - Text Containing Spoilers', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Ẩn văn bản có thể dùng spoilers để nó phải được bấm bởi người xem mới có thể nhìn thấy.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[SPOILER]Simple spoiler[/SPOILER]
[SPOILER=Spoiler Title]Spoiler with a title[/SPOILER]', array(array('preEscaped', array()),), false),
		'anchor' => 'spoiler',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[CODE], [PHP], [HTML] - Programming Code Display', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Hiển hị ký tự dưới dạng một số ngôn ngữ lập trình.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[CODE]General
code[/CODE]
[PHP]echo $hello . \'world\';[/PHP]', array(array('preEscaped', array()),), false),
		'anchor' => 'code',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[ICODE] - Inline programming code display', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Allows you to display code inline among normal post content. Syntax will not be highlighted.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('Inline code blocks [ICODE]are a convenient way[/ICODE] of displaying code inline.', array(array('preEscaped', array()),), false),
		'anchor' => 'icode',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[INDENT] - Text Indent', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Canh lề văn bản. Điều này có thể được lồng vào nhau cho indentings lớn hơn.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('Regular text
[INDENT]Indented text
[INDENT]More indented[/INDENT]
[/INDENT]', array(array('preEscaped', array()),), false),
		'anchor' => 'indent',
	), $__vars) . '

			' . $__templater->callMacro(null, 'row_output', array(
		'title' => $__templater->filter('[PLAIN] - Plain Text', array(array('preEscaped', array()),), false),
		'desc' => $__templater->filter('Vô hiệu hóa BB code dịch trên văn bản bọc.', array(array('preEscaped', array()),), false),
		'example' => $__templater->filter('[PLAIN]This is not [B]bold[/B] text.[/PLAIN]', array(array('preEscaped', array()),), false),
		'anchor' => 'plain',
	), $__vars) . '

			<li class="bbCodeHelpItem block-row block-row--separated">
				<span class="u-anchorTarget" id="attach"></span>
				<h3 class="block-textHeader">' . '[ATTACH] - Attachment Insertion' . '</h3>
				<div>' . 'Chèn một file đính kèm tạivị trí quy định. Nếu tập tin đính kèm là một hình ảnh, một hình ảnh thu nhỏ hoặc phiên bản kích thước đầy đủ sẽ được chèn vào. Điều này thường sẽ được chèn bằng cách nhấn vào nút thích hợp.' . '</div>
				<div class="bbCodeDemoBlock">
					<dl class="bbCodeDemoBlock-item">
						<dt>' . 'Ví dụ' . $__vars['xf']['language']['label_separator'] . '</dt>
						<dd>
							' . 'Hình thu nhỏ' . $__vars['xf']['language']['label_separator'] . ' [ATTACH]123[/ATTACH]<br />
							' . 'Full Size' . $__vars['xf']['language']['label_separator'] . ' [ATTACH=full]123[/ATTACH]
						</dd>
					</dl>
					<dl class="bbCodeDemoBlock-item">
						<dt>' . 'Hiển thị' . $__vars['xf']['language']['label_separator'] . '</dt>
						<dd><i>' . 'The contents of the attachments would appear here.' . '</i></dd>
					</dl>
				</div>
			</li>

			';
	if ($__templater->isTraversable($__vars['bbCodes'])) {
		foreach ($__vars['bbCodes'] AS $__vars['bbCode']) {
			if (!$__templater->test($__vars['bbCode']['example'], 'empty', array())) {
				$__finalCompiled .= '
				<li class="bbCodeHelpItem block-row block-row--separated">
					<span class="u-anchorTarget" id="' . $__templater->escape($__vars['bbCode']['bb_code_id']) . '"></span>
					<h3 class="block-textHeader">
						';
				if (($__vars['bbCode']['has_option'] == 'no') OR ($__vars['bbCode']['has_option'] == 'optional')) {
					$__finalCompiled .= '[' . $__templater->filter($__vars['bbCode']['bb_code_id'], array(array('to_upper', array()),), true) . ']';
				}
				$__finalCompiled .= '
						';
				if ($__vars['bbCode']['has_option'] == 'optional') {
					$__finalCompiled .= '<span role="presentation" aria-hidden="true">&middot;</span>';
				}
				$__finalCompiled .= '
						';
				if (($__vars['bbCode']['has_option'] == 'yes') OR ($__vars['bbCode']['has_option'] == 'optional')) {
					$__finalCompiled .= '[' . $__templater->filter($__vars['bbCode']['bb_code_id'], array(array('to_upper', array()),), true) . '=<span class="block-textHeader-highlight">option</span>]';
				}
				$__finalCompiled .= '
						- ' . $__templater->escape($__vars['bbCode']['title']) . '
					</h3>
					';
				$__compilerTemp1 = '';
				$__compilerTemp1 .= $__templater->escape($__vars['bbCode']['description']);
				if (strlen(trim($__compilerTemp1)) > 0) {
					$__finalCompiled .= '
						<div>' . $__compilerTemp1 . '</div>
					';
				}
				$__finalCompiled .= '
					<div class="bbCodeDemoBlock">
						<dl class="bbCodeDemoBlock-item">
							<dt>' . 'Ví dụ' . $__vars['xf']['language']['label_separator'] . '</dt>
							<dd>' . $__templater->filter($__vars['bbCode']['example'], array(array('nl2br', array()),), true) . '</dd>
						</dl>
						<dl class="bbCodeDemoBlock-item">
							<dt>' . 'Hiển thị' . $__vars['xf']['language']['label_separator'] . '</dt>
							<dd>' . (!$__templater->test($__vars['bbCode']['output'], 'empty', array()) ? $__templater->escape($__vars['bbCode']['output']) : $__templater->fn('bb_code', array($__vars['bbCode']['example'], 'help', null, ), true)) . '</dd>
						</dl>
					</div>
				</li>
			';
			}
		}
	}
	$__finalCompiled .= '

		</ul>
	</div>
</div>

' . '

';
	return $__finalCompiled;
});