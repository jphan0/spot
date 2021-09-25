from youtube_search import YoutubeSearch
import sys
query = sys.argv[1]

results = YoutubeSearch(query, max_results=1).to_json()

print(results)