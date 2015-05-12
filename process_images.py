# to make figures in png and thumbnails.
import os, sys, subprocess
from PIL import Image

# def to_png(infile):
# 	f, e = os.path.splitext(infile)
# 	f = f.lower().replace(' ', '')
# 	outfile = f + ".png"
# 	Image.open(infile).save(outfile)
# 	return

def to_thumbnail(infile):
	size = (160,210)
	f, e = os.path.splitext(infile)
	f = f.lower().replace(' ', '')
	outfile = f + "_thumb.png"
	im = Image.open(infile)
	im.thumbnail(size)
	im.save(outfile, "JPEG")
	return


os.chdir('/Users/zichen/Documents/Zichen_Projects/miR_esrrb')
for fn in os.listdir('/Users/zichen/Documents/Zichen_Projects/miR_esrrb'):
	if fn.endswith('.png') and 'figure' in fn:
		print fn
		# to_png(fn)
		to_thumbnail(fn)

