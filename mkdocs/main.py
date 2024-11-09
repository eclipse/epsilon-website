import requests

def define_env(env):

	@env.macro
	def example(url, tabs=False):
		url = "https://raw.githubusercontent.com/eclipse-epsilon/epsilon/main/examples/" + url
		if tabs:
			return '\t'.join(requests.get(url).text.splitlines(True))
		else:
			return requests.get(url).text