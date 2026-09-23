from PIL import Image

def remove_background(input_path, output_path, tolerance=30):
    img = Image.open(input_path)
    img = img.convert("RGBA")
    
    datas = img.getdata()
    newData = []
    
    for item in datas:
        # Check if pixel is close to white (255, 255, 255)
        if (abs(item[0] - 255) < tolerance and 
            abs(item[1] - 255) < tolerance and 
            abs(item[2] - 255) < tolerance):
            newData.append((255, 255, 255, 0)) # Make it transparent
        else:
            newData.append(item)
            
    img.putdata(newData)
    img.save(output_path, "PNG")

remove_background("public/assets/images/shanti_nagar_logo.jpg", "public/assets/images/shanti_nagar_logo.png")
