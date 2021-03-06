# [Antwort](http://internations.github.com/antwort)

### Responsive Layouts for Email
![Responsive Layouts for Email](http://internations.github.io/antwort/images/antwort-v1-graphic.png "Responsive Layouts for Email")

Antwort offers responsive layouts for Email that both fits _and_ adapts to client widths. Don't underwhelm desktop users with single column layouts that work for mobile. Antwort offers columns on desktop that automatically become rows on mobile.

Author: Julie Ng ([@jng5](http://twitter.com/jng5))  
Date: October 2014  
Version: 1.0.0  

## Features

* Works on mobile: Mail on iOS and Email on Android.
* Works in major clients like AOL, gmail, outlook.com and Yahoo.
* Even works in Outlook (2000+).
* Bulletproof layouts: made with dynamic content in mind.
* Minimalist in design for maximum customizability.

### NEW since v1.0

* __Source templates__  
  Antwort now includes the source templates (pre inlined CSS) for your reference. This lets you easily customize the template for your own use. Each template has a `build.html` with inlined CSS as well as the original source files in a `source` folder.
  
* __Support for Android 4.3+__  
  Antwort v0 relied on applying `display: block;` to `<td>` to force columns into rows. Starting with Android 4.3, that is no longer possible, i.e. columns remain columns. 
  
  Antwort v1 relies on conditional wrapper tables to support Microsoft Outlook desktop clients. The columns themselves are no longer `<td>`s but `<table>`s, whose width expand to 100% on mobile devices.

## Included Templates

Included templates as of v1.0.0 release (14 October 2014):

<table>
  <tbody>
    <tr>
      <td align="center" valign="top">
        <strong>Single Column</strong><br><br>
        <img src="http://internations.github.io/antwort/images/v1-previews/1-col.png" style="max-width: 95%;">
      </td>
      <td align="center" valign="top">
        <strong>Two Columns (text)</strong><br><br>
        <img src="http://internations.github.io/antwort/images/v1-previews/2-cols.png" style="max-width: 95%;">
      </td>
      <td align="center" valign="top">
        <strong>Three Columns (images)</strong><br><br>
        <img src="http://internations.github.io/antwort/images/v1-previews/3-cols-images.png" style="max-width: 95%;">
      </td>
    </tr>
    <tr>
      <td align="center"><a href="https://litmus.com/pub/23497a4" target="_blank">Litmus Previews</a></td>
      <td align="center"><a href="https://litmus.com/pub/2e0aaa0" target="_blank">Litmus Previews</a></td>
      <td align="center"><a href="https://litmus.com/pub/de912ba" target="_blank">Litmus Previews</a></td>
    </tr>
  </tbody>
</table>



## How to use Antwort

Antwort is **not** a framework. Antwort is meant to teach you how to do responsive layouts for Email. That's why source pre-lined HTML is now included for you to learn from.
  
#### Need help?

Before [posting an issue](https://github.com/InterNations/antwort/issues), please

1. Make sure you are sending the email from an Email Service Provider (ESP), for example MailChimp **not** your Email client e.g. Outlook.
2. Double check any code changes you might have made
3. Do a test send to yourself and view the source. Did your ESP change the code?



## Changelog

### 1.0.0

14 October 2014

* Complete re-write of code, to reflect latest email development challenges, especially with Android 4.3+
* New: include source folders before inlining CSS.
* New: single column fluid layout
* Footer now includes example address, which has an example for removing blue iOS links.


### 0.1.2 

April 2013

* Fixed issue #8 - headlines no longer centered in Outlook.com and older Outlook.
* Fixed issue #7 - moved padding overrides to parent `<td>` in mobile styles.

### 0.1.1

26 March 2013

* Fixed column margin issue after [Hotmail/Outlook dropped margin support](https://litmus.com/blog/hotmail-and-outlook-com-drop-support-for-margin).
* Issue #5 fixed - Outlook.com parses HTML tags in comments.
* Issue #3 fixed - control characters removed from template.
* Added screenshots of current version from Litmus test.
 

### 0.1.0

4 Jan 2013

* Hello open source world.


## License
Antwort is provided under the MIT License - see LICENSE.md for full details.
