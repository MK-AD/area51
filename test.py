#https://regex101.com/

number = 1260

def get_biggest_binary_gap(number):
	import re
	
	binary_data = "{0:b}".format(number)
	print(str(number) + ' int to bin ' + binary_data)
	# not the right regex .... 
	gaps = re.findall("1*(0+)1", binary_data)
	
	longest_gap = 0
	longest_gap_key = ''
	print(gaps)
	for gap in gaps:
		if len(gap) > longest_gap:
			longest_gap = len(gap)
			longest_gap_key = gap
	
	return longest_gap_key

	
print(get_biggest_binary_gap(number))

