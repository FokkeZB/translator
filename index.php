<?

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $language = $_POST['pk'];
  $name = $_POST['name'];
  $value = $_POST['value'];
  $filename = './i18n/' . $language . '/strings.xml';

  $xml = simplexml_load_file($filename);

  if (!$xml) {
    http_response_code(400);
    exit('Cannot find language file: ' . $language);
  }

  $strings = $xml->xpath('/resources/string[@name="' . $name . '"]');

  if (count($strings) !== 1) {
    http_response_code(400);
    exit('Found 0 or multiple strings named: ' + $name);
  }

  $strings[0][0] = $value;

  if (!$xml->asXML($filename)) {
    http_response_code(400);
    exit('Could not write to: ' . $language);
  }

  exit;
}

$languages = array_slice(scandir('./i18n'), 2);
$strings = array();
$names = array();

foreach ($languages as $language) {
  $strings[$language] = array();

  $xml = simplexml_load_file('./i18n/' . $language . '/strings.xml');

  foreach ($xml->string as $key => $string) {
    $strings[$language][(string) $string['name']] = (string) $string;
  }

  $names = array_merge($names, array_keys($strings[$language]));
}

$names = array_unique($names);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Translator</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script>
    $(document).ready(function() {
      $('td span').editable({
        type: 'text',
        mode: 'inline',
        url: './'
      });
    });
    </script>
  </head>
  <body>
    <table class="table table-striped">
      <thead>
        <th>name</th>
        <? foreach ($languages as $language): ?>
          <th><?= $language ?></th>
        <? endforeach ?>
      </thead>
      <tbody>
        <? foreach ($names as $name): ?>
          <tr>
            <th><?= $name ?></th>
            <? foreach ($languages as $language): ?>
              <td><span data-pk="<?= $language ?>" data-name="<?= $name ?>"><?= isset($strings[$language][$name]) ? $strings[$language][$name] : '' ?></span></td>
            <? endforeach ?>
          </tr>
        <? endforeach ?>
      </tbody>
    </table>
  </body>
</html>