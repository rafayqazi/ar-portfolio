import os
import json
from PIL import Image

def generate_thumbnails():
    thumbs_dir = os.path.join('images', 'thumbs')
    os.makedirs(thumbs_dir, exist_ok=True)
    
    with open('scripts/thumbs_map.json', 'r', encoding='utf-8') as f:
        items = json.load(f)

    for item in items:
        pid = item['id']
        img_rel = item['img'].replace('%20', ' ')
        if not os.path.exists(img_rel):
            print(f"File not found: {img_rel}")
            continue
        
        thumb_name = f"{pid}.webp"
        thumb_path = os.path.join(thumbs_dir, thumb_name)
        
        try:
            with Image.open(img_rel) as im:
                if im.mode in ('RGBA', 'LA') or (im.mode == 'P' and 'transparency' in im.info):
                    im = im.convert('RGBA')
                else:
                    im = im.convert('RGB')
                
                max_w = 640
                if im.width > max_w:
                    ratio = max_w / float(im.width)
                    new_h = int(im.height * ratio)
                    im = im.resize((max_w, new_h), Image.Resampling.LANCZOS)
                
                im.save(thumb_path, 'WEBP', quality=82, method=6)
                orig_size = os.path.getsize(img_rel) / 1024
                thumb_size = os.path.getsize(thumb_path) / 1024
                print(f"Saved {thumb_name}: {orig_size:.0f}KB -> {thumb_size:.0f}KB")
        except Exception as e:
            print(f"Error processing {img_rel}: {e}")

if __name__ == '__main__':
    generate_thumbnails()
