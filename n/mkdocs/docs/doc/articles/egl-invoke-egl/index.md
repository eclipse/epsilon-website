# Re-using EGL templates

Sometimes it may be handy to send the output of one EGL template into another EGL template. This is a great idea because it will make your templates more modular, cohesive and lead to less code overall. For example, suppose you've been generating an XML file for each Book in your model. Hence, you have a Book2XML.egl template with the following contents:

```egl
<book>
  <title>[%=title%]</title>
  <isbn>[%=isbn%]</isbn>
  <pages>[%=pages.asString()%]</pages>
  <authors>
  [% for (author in authors) {%]
    <author name="[%=author.name%]"/>
  [%}%]
  </authors>
</book>
```

Suppose that now you also want to generate a single XML for each Library; where a Library is a collection of Books. Instead of duplicating the code in Book2XML.egl, you can re-use it by calling it from Library2XML.egl, like so:

```egl
<library id=[%=lib.id%] name="[%=lib.name%]">
[% for (book in lib.books) {
  var bookTemplate : Template = TemplateFactory.load("/path/to/Book2XML.egl");
  bookTemplate.populate("book", book);
  bookTemplate.populate("title", book.title);
  bookTemplate.populate("isbn", book.isbn);
  bookTemplate.populate("pages", book.pages);
  bookTemplate.populate("authors", book.authors);
  %]

  [%=bookTemplate.process()%]
[%}%]
```

As with EGX, you can pass parameters to the invoked template using the "populate" operation, where the first parameter is the variable name (that the invoked template will see) and the second parameter is the value.
