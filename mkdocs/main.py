import requests

def define_env(env):

	@env.macro
	def example(url, tabs=False):
		url = "https://git.eclipse.org/c/epsilon/org.eclipse.epsilon.git/plain/examples/" + url
		if tabs:
			return '\t'.join(requests.get(url).text.splitlines(True))
		else:
			return requests.get(url).text