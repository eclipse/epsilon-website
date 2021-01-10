# Monitoring and Instrumenting Epsilon Programs

Epsilon interpreters provide support for hooking into the execution of model management programs. This can be useful for monitoring and instrumenting Epsilon programs at runtime, and for computing metrics (e.g. model/metamodel/statement coverage, performance metrics) of interest.

The listing below demonstrates parsing an EOL program and adding an `IExecutionListener` to its interpreter, which prints the program's statements/expressions to the console as soon as they are executed.

```java
public static void main(String[] args) throws Exception {
	
	EolModule module = new EolModule();
	module.parse("for (i in 1.to(10)) { i.println(); }");
	module.getContext().getExecutorFactory().addExecutionListener(
		new IExecutionListener() {
		
			@Override
			public void finishedExecutingWithException(ModuleElement me, 
				EolRuntimeException exception, IEolContext context) {}
			
			@Override
			public void finishedExecuting(ModuleElement me, Object result, 
				IEolContext context) {
				
				System.out.println(me);
			}
			
			@Override
			public void aboutToExecute(ModuleElement me, IEolContext context) {}
		}
	);
	module.execute();
}
```

To monitor the execution of an ETL transformation, EVL constraints etc. you can replace `EolModule` with `EtlModule`, `EvlModule` etc.