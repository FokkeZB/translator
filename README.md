# Translator

A small but helpful script for translating your ([Titanium](http://docs.appcelerator.com/titanium/latest/#!/guide/Titanium_Command-Line_Interface_Reference)) apps.

![screenshot](https://github.com/fokkezb/translator/raw/master/screenshot.png)

# How to use

1. Copy the `index.php` to a server.
2. Secure the directory or just make the URL hard to guess :)
3. Replace the `i18n` directory by the one of your app.
4. Point people to the URL to translate the strings.
5. Download the `i18n` directory back to your app or use [ti-i18n](https://nodei.co/npm/ti-i18n/) to merge the files with your local copies if you have made local changes in the mean time.

# Google Translator Toolkit

As an alternative, you could also use [Google Translator Toolkit](http://translate.google.com/toolkit/). It provides automatic translation, translation memory and glossaries. Nice features, but I was in need of a more simple and efficient copy-paste-go solution.


## License

<pre>
Copyright 2013 Fokke Zandbergen

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
</pre>
