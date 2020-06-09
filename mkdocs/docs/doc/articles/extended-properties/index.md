# Extended Properties

This article demonstrates the extended properties mechanism in EOL (and by inheritance, in all languages in Epsilon). We present the rationale and semantics of extended properties using the following simple metamodel (in Emfatic):

```emf
package SimpleTree;

class Tree {
  attr String name;
  ref Tree#children parent;
  val Tree[*]#parent children;
}
```

Now, what we want to do is to traverse a model that conforms to this metamodel and calculate and print the depth of each Tree in it. We can do this using this simple EOL program:

```eol
var depths = new Map;

for (n in Tree.allInstances.select(t|not t.parent.isDefined())) {
  n.setDepth(0);
}

for (n in Tree.allInstances) {
  (n.name + " " + depths.get(n)).println();
}

operation Tree setDepth(depth : Integer) {
  depths.put(self,depth);
  for (c in self.children) {
    c.setDepth(depth + 1);
  }
}
```

Because the `Tree` `EClass` doesn't have a depth property, we have to use the `depths Map` to store the calculated depth of each `Tree`. Another solution would be to add a depth property to the `Tree` `EClass` so that its instances can store such information; but following this approach will soon pollute our metamodel with information of secondary importance.

We've often come across similar situations where we needed to attach some kind of information (that is not supported by the metamodel) to particular model elements during model management operations (validation, transformation etc.). Until now, we've been using `Maps` to achieve this (similarly to what we've done above). However, now, EOL (and all languages built atop it) support non-invasive extended properties which provide a more elegant solution to this recurring problem.

An extended property is a property that starts with the `~` character. Its semantics are quite straightforward: the first time a value is assigned to an extended property of an object (e.g. `x.~a := b;`), the property is created and associated to the object and the value is assigned to it. Similarly, `x.~a` returns the value of the property or undefined if the property has not been set on the particular object yet. Using extended properties, we can rewrite the above code (without needing to use a `Map`) as follows:

```eol
for (n in Tree.allInstances.select(t|not t.parent.isDefined())) {
  n.setDepth(0);
}

for (n in Tree.allInstances) {
  (n.name + " " + n.~depth).println();
}

operation Tree setDepth(depth : Integer) {
  self.~depth = depth;
  for (c in self.children) {
    c.setDepth(depth + 1);
  }
}
```
