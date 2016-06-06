<?xml version="1.0"?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Nonprofit Search API</title>
    <style type="text/css">
        body {
            font-family: Trebuchet MS, sans-serif;
            font-size: 15px;
            color: #444;
            margin-right: 24px;
        }

        h1	{
            font-size: 25px;
        }
        h2	{
            font-size: 20px;
        }
        h3	{
            font-size: 16px;
            font-weight: bold;
        }
        hr	{
            height: 1px;
            border: 0;
            color: #ddd;
            background-color: #ddd;
            display: none;
        }

        .app-desc {
            clear: both;
            margin-left: 20px;
        }
        .param-name {
            width: 100%;
        }
        .license-info {
            margin-left: 20px;
        }

        .license-url {
            margin-left: 20px;
        }

        .model {
            margin: 0 0 0px 20px;
        }

        .method {
            margin-left: 20px;
        }

        .method-notes	{
            margin: 10px 0 20px 0;
            font-size: 90%;
            color: #555;
        }

        pre {
            padding: 10px;
            margin-bottom: 2px;
        }

        .http-method {
            text-transform: uppercase;
        }

        pre.get {
            background-color: #0f6ab4;
        }

        pre.post {
            background-color: #10a54a;
        }

        pre.put {
            background-color: #c5862b;
        }

        pre.delete {
            background-color: #a41e22;
        }

        .huge	{
            color: #fff;
        }

        pre.example {
            background-color: #f3f3f3;
            padding: 10px;
            border: 1px solid #ddd;
        }

        code {
            white-space: pre;
        }

        .nickname {
            font-weight: bold;
        }

        .method-path {
            font-size: 1.5em;
            background-color: #0f6ab4;
        }

        .up {
            float:right;
        }

        .parameter {
            width: 500px;
        }

        .param {
            width: 500px;
            padding: 10px 0 0 20px;
            font-weight: bold;
        }

        .param-desc {
            width: 700px;
            padding: 0 0 0 20px;
            color: #777;
        }

        .param-type {
            font-style: italic;
        }

        .param-enum-header {
            width: 700px;
            padding: 0 0 0 60px;
            color: #777;
            font-weight: bold;
        }

        .param-enum {
            width: 700px;
            padding: 0 0 0 80px;
            color: #777;
            font-style: italic;
        }

        .field-label {
            padding: 0;
            margin: 0;
            clear: both;
        }

        .field-items	{
            padding: 0 0 15px 0;
            margin-bottom: 15px;
        }

        .return-type {
            clear: both;
            padding-bottom: 10px;
        }

        .param-header {
            font-weight: bold;
        }

        .method-tags {
            text-align: right;
        }

        .method-tag {
            background: none repeat scroll 0% 0% #24A600;
            border-radius: 3px;
            padding: 2px 10px;
            margin: 2px;
            color: #FFF;
            display: inline-block;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h1>Nonprofit Search API</h1>
<div class="app-desc">Allows you to quickly search Nonprofit organizations</div>
<div class="app-desc">Version: 0.1.0</div>
<div class="app-desc">BasePath:/</div>
<h2>Access</h2>

<h2><a name="__Methods">Methods</a></h2>
[ Jump to <a href="#__Models">Models</a> ]

<h2>Table of Contents </h2>
<div class="method-summary"></div>
<ol>
    <li><a href="#apiNonprofitsSearchGet"><code><span class="http-method">get</span> /api/nonprofits/search</code></a></li>
</ol>

<div class="method"><a name="apiNonprofitsSearchGet"/>
    <div class="method-path">
        <a class="up" href="#__Methods">Up</a>
        <pre class="get"><code class="huge"><span class="http-method">get</span> /api/nonprofits/search</code></pre></div>
    <div class="method-summary">Searching Nonprofits (<span class="nickname">apiNonprofitsSearchGet</span>)</div>
    <div class="method-notes">Returns all the organizations of the given query string.  The function considers the name, ein, city and state of the organization. </div>





    <h3 class="field-label">Query parameters</h3>
    <div class="field-items">
        <div class="param">q (required)</div>

        <div class="param-desc"><span class="param-type">Query Parameter</span> &mdash; The query search for the organization </div>
    </div>  <!-- field-items -->


    <h3 class="field-label">Return type</h3>
    <div class="return-type">
        <a href="#inline_response_200">inline_response_200</a>

    </div>

    <!--Todo: process Response Object and its headers, schema, examples -->


    <h3 class="field-label">Produces</h3>
    This API call produces the following media types according to the <span class="header">Accept</span> request header;
    the media type will be conveyed by the <span class="heaader">Content-Type</span> response header.
    <ul>
        <li><code>application/json</code></li>
    </ul>

    <h3 class="field-label">Responses</h3>
    <h4 class="field-label">200</h4>
    The results of the search
    <a href="#inline_response_200">inline_response_200</a>
</div> <!-- method -->
<hr/>

<div class="up"><a href="#__Models">Up</a></div>
<h2><a name="__Models">Models</a></h2>
[ Jump to <a href="#__Methods">Methods</a> ]

<h2>Table of Contents</h2>
<ol>
    <li><a href="#Inline_response_200"><code>Inline_response_200</code></a></li>
    <li><a href="#Nonprofit"><code>Nonprofit</code></a></li>
</ol>

<div class="model">
    <h3 class="field-label"><a name="Inline_response_200">Inline_response_200</a> <a class="up" href="#__Models">Up</a></h3>
    <div class="field-items">
        <div class="param">data (optional)</div><div class="param-desc"><span class="param-type"><a href="#Nonprofit">array[Nonprofit]</a></span> </div>
    </div>  <!-- field-items -->
</div>
<div class="model">
    <h3 class="field-label"><a name="Nonprofit">Nonprofit</a> <a class="up" href="#__Models">Up</a></h3>
    <div class="field-items">
        <div class="param">id (optional)</div><div class="param-desc"><span class="param-type"><a href="#integer">Integer</a></span> the id of the nonprofit in the database.  Not critical as this might change when the data is refreshed</div>
        <div class="param">ein (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> the ein of the organization.  this is the value that&#39;s needed if query individually.</div>
        <div class="param">name (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> the name of the organization.</div>
        <div class="param">city (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> the city in which the organization resides.</div>
        <div class="param">state (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">String</a></span> the state in which the organization resides.</div>
        <div class="param">deductibility_status_code (optional)</div><div class="param-desc"><span class="param-type"><a href="#string">array[String]</a></span> the types of organization it is.  The value will always return an array, even if the organization is only one type of org.</div>
    </div>  <!-- field-items -->
</div>
</body>
</html>
