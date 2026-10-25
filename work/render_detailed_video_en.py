#!/usr/bin/env python3
"""
Rotary Club of Shantinagar Dhaka - Detailed Documentary Presentation Video
- Relaxing, Confident Presentation Voiceover by Aman (Pure speech, zero music)
- Natural Conversational Phrasing with Human Breathing Pauses
- Simple, Engaging On-Screen English Typography (Arial Bold & Regular)
- 7 In-Depth Chapters:
    1. Welcome & Our Story (0.0s - 16.0s)
    2. Dedicated Leadership & Governance (16.0s - 32.0s)
    3. Caring for Mothers & Newborns (32.0s - 47.0s)
    4. Clean Drinking Water for Schoolchildren (47.0s - 61.0s)
    5. Winter Relief & Nationwide Green Drive (61.0s - 76.0s)
    6. 100% Honest, Open & Accountable to You (76.0s - 90.0s)
    7. Join Our Journey & Contact (90.0s - 104.0s)
"""

import os
import sys
import subprocess
import textwrap
from PIL import Image, ImageDraw, ImageFont

WIDTH, HEIGHT = 1920, 1080
FPS = 30
TOTAL_FRAMES = 3120  # 104.0 seconds
OUTPUT_DIR = "brag-output"
POSTER_PATH = os.path.join(OUTPUT_DIR, "brag.jpg")
FINAL_VIDEO_PATH = os.path.join(OUTPUT_DIR, "brag.mp4")
AUDIO_PATH = "work/master_audio.wav"

FONT_BOLD_PATH = "/System/Library/Fonts/Supplemental/Arial Bold.ttf"
FONT_REG_PATH = "/System/Library/Fonts/Supplemental/Arial.ttf"

def load_font(size, bold=True):
    path = FONT_BOLD_PATH if bold else FONT_REG_PATH
    try:
        return ImageFont.truetype(path, size)
    except Exception:
        return ImageFont.load_default()

# Typography hierarchy
f_hero = load_font(48, True)
f_title_lg = load_font(38, True)
f_title_md = load_font(28, True)
f_title_sm = load_font(22, True)
f_sub_lg = load_font(21, False)
f_sub_md = load_font(18, False)
f_sub_sm = load_font(15, False)
f_badge = load_font(14, True)
f_stat_val = load_font(52, True)
f_stat_lbl = load_font(18, False)

# Media Assets
LOGO_IMG = Image.open("public/assets/images/logo.png").convert("RGBA")
IMG_ASSEMBLY = Image.open("public/assets/images/gallery-albums/club-governance-and-meetings/ocv-general-assembly-portrait.jpeg").convert("RGB")
IMG_HOSPITAL = Image.open("public/assets/images/gallery-albums/health-and-medical-aid/medical-equipment-hospital-handover.jpeg").convert("RGB")
IMG_NUTRITION = Image.open("public/assets/images/gallery-albums/community-service-and-relief/pushti-nutrition-handover-mother.jpeg").convert("RGB")
IMG_WATER = Image.open("public/assets/images/gallery-albums/community-service-and-relief/water-purifier-installation-children.jpeg").convert("RGB")
IMG_FILTER = Image.open("public/assets/images/gallery-albums/community-service-and-relief/water-filter-technical-setup.jpeg").convert("RGB")
IMG_WINTER = Image.open("public/assets/images/projects/covers/winter-clothes-blanket.jpeg").convert("RGB")
IMG_TREE = Image.open("public/assets/images/projects/covers/tree-plantation-campaign.jpeg").convert("RGB")
IMG_LEADERSHIP = Image.open("public/assets/images/gallery-albums/awards-and-recognition/district-conference-stage-lineup.jpeg").convert("RGB")

BOD_MEMBERS = [
    {
        "name": "Rtn. Shah Arifur Rahman",
        "title": "Club President (RY 2026-27)",
        "badge": "PRESIDENT",
        "photo": Image.open("public/assets/images/members/rtn-shah-arifur-rahman.jpg").convert("RGB"),
        "color": (255, 184, 28)
    },
    {
        "name": "Rtn. Md. Shamim Rahman",
        "title": "Club Secretary",
        "badge": "SECRETARY",
        "photo": Image.open("public/assets/images/members/rtn-shamim-rahman.jpg").convert("RGB"),
        "color": (56, 189, 248)
    },
    {
        "name": "Rtn. Md Mominul Islam",
        "title": "Immediate Past President",
        "badge": "IPP",
        "photo": Image.open("public/assets/images/members/rtn-mominul-islam.jpg").convert("RGB"),
        "color": (52, 211, 153)
    },
    {
        "name": "Rtn. Ujjal Kanti Dey",
        "title": "President Elect (PE)",
        "badge": "PRESIDENT ELECT",
        "photo": Image.open("public/assets/images/members/rtn-ujjal-kanti-dey.jpg").convert("RGB"),
        "color": (244, 114, 182)
    },
    {
        "name": "Rtn. Fahima Nazneen Rahman",
        "title": "Vice President, RFSM",
        "badge": "VICE PRESIDENT",
        "photo": Image.open("public/assets/images/members/rtn-fahima-nazneen-rahman.jpg").convert("RGB"),
        "color": (255, 184, 28)
    },
    {
        "name": "Rtn. Md Shariful Islam Shovo",
        "title": "Club Treasurer",
        "badge": "TREASURER",
        "photo": Image.open("public/assets/images/members/rtn-shariful-islam-shovo.jpg").convert("RGB"),
        "color": (56, 189, 248)
    }
]

def create_base_canvas(frame_idx):
    base = Image.new("RGB", (WIDTH, HEIGHT), (5, 20, 42))
    draw = ImageDraw.Draw(base)
    cx = WIDTH // 2
    cy = int(HEIGHT * 0.45)
    for r in range(900, 150, -80):
        factor = (1.0 - r / 900.0) * 0.20
        col = (
            int(5 + (0 - 5) * factor),
            int(20 + (93 - 20) * factor),
            int(42 + (170 - 42) * factor)
        )
        draw.ellipse([cx - r, cy - r, cx + r, cy + r], fill=col)
    return base

def draw_badge(draw, box, text, font, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0)):
    draw.rounded_rectangle(box, radius=(box[3] - box[1]) // 2, fill=fill, outline=outline, width=2)
    bbox = font.getbbox(text)
    tw = bbox[2] - bbox[0]
    th = bbox[3] - bbox[1]
    bx = box[0] + (box[2] - box[0] - tw) // 2
    by = box[1] + (box[3] - box[1] - th) // 2 - bbox[1]
    draw.text((bx, by), text, font=font, fill=text_color)

# ==============================================================================
# CHAPTER 1: WELCOME & OUR STORY (0.0s - 16.0s, frames 0 - 480)
# ==============================================================================
def render_chapter_1(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    logo_sz = 100
    logo_resized = LOGO_IMG.resize((logo_sz, logo_sz), Image.Resampling.LANCZOS)
    canvas.paste(logo_resized, (100, 55), logo_resized)
    
    draw_badge(draw, [220, 55, 680, 92], "ROTARY INTERNATIONAL DISTRICT 3281 • CHARTERED 2005", f_badge, fill=(0, 45, 90), outline=(0, 140, 255), text_color=(125, 211, 252))
    draw.text((220, 105), "Rotary Club of Shantinagar Dhaka", font=f_hero, fill=(255, 255, 255))
    draw.text((220, 168), "Over 20 Years of Grassroots Service, Care & Community Impact Across Bangladesh", font=f_sub_lg, fill=(203, 213, 225))
    
    card_y = 235
    card_h = 615
    card_w = 540
    spacing = 45
    start_x = 100
    
    pillars = [
        {
            "tag": "COMMUNITY FOCUS 01",
            "title": "Maternal & Child Health",
            "lead": "Supporting mothers and newborns with essential medical equipment and nutritious food.",
            "points": [
                "Partnership with Azimpur Maternity & Child Hospital",
                "500+ nutritious food and care boxes delivered directly",
                "Newborn baby incubators, ceiling fans & medical tools"
            ],
            "color": (255, 184, 28)
        },
        {
            "tag": "COMMUNITY FOCUS 02",
            "title": "Clean School Water",
            "lead": "Protecting schoolchildren with modern water filters so they grow healthy and happy.",
            "points": [
                "Modern filtration plant installed at Sadik Model School",
                "1,200+ students drink clean, fresh water every school day",
                "Completely free from arsenic, germs & harmful metals"
            ],
            "color": (56, 189, 248)
        },
        {
            "tag": "COMMUNITY FOCUS 03",
            "title": "Honest & Open To You",
            "lead": "Complete trust with instant donor receipts and open public expense reports.",
            "points": [
                "Instant digital receipt for every single contribution",
                "All project vouchers are openly published on our website",
                "Zero administrative waste; 100% volunteer-led action"
            ],
            "color": (52, 211, 153)
        }
    ]
    
    for i, p in enumerate(pillars):
        bx = start_x + i * (card_w + spacing)
        draw.rounded_rectangle([bx, card_y, bx + card_w, card_y + card_h], radius=20, fill=(10, 26, 50), outline=p["color"], width=2)
        
        draw_badge(draw, [bx + 35, card_y + 35, bx + 230, card_y + 72], p["tag"], f_badge, fill=(0, 45, 90), outline=p["color"], text_color=p["color"])
        draw.text((bx + 35, card_y + 92), p["title"], font=f_title_sm, fill=(255, 255, 255))
        
        lead_lines = textwrap.wrap(p["lead"], width=38)
        for l_idx, l in enumerate(lead_lines):
            draw.text((bx + 35, card_y + 135 + l_idx * 26), l, font=f_sub_sm, fill=(203, 213, 225))
            
        draw.line([bx + 35, card_y + 205, bx + card_w - 35, card_y + 205], fill=(255, 255, 255, 30), width=1)
        
        for j, pt in enumerate(p["points"]):
            py_item = card_y + 235 + j * 115
            draw.ellipse([bx + 38, py_item + 6, bx + 48, py_item + 16], fill=p["color"])
            pt_lines = textwrap.wrap(pt, width=34)
            for pt_idx, ptl in enumerate(pt_lines):
                col_pt = (241, 245, 249) if pt_idx == 0 else (148, 163, 184)
                draw.text((bx + 62, py_item + pt_idx * 26), ptl, font=f_sub_md, fill=col_pt)

    ribbon_y = 880
    draw.rounded_rectangle([100, ribbon_y, 1820, ribbon_y + 120], radius=16, fill=(0, 93, 170), outline=(255, 184, 28), width=2)
    draw.text((140, ribbon_y + 22), "SERVICE ABOVE SELF • Real Help, Real Hope", font=f_title_md, fill=(255, 184, 28))
    draw.text((140, ribbon_y + 68), "Official Rotary Motto • Bringing smiles, dignity, and real support to communities across Bangladesh since 2005", font=f_sub_md, fill=(226, 232, 240))
    draw.text((1480, ribbon_y + 44), "ESTABLISHED: 2005", font=f_title_sm, fill=(255, 255, 255))

    return canvas

# ==============================================================================
# CHAPTER 2: BOARD OF DIRECTORS (16.0s - 32.0s, frames 480 - 960)
# ==============================================================================
def render_chapter_2(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    draw_badge(draw, [100, 55, 540, 92], "CLUB LEADERSHIP • BOARD OF DIRECTORS 2026-2027", f_badge, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0))
    draw.text((100, 105), "Dedicated Leaders Serving With Heart", font=f_title_lg, fill=(255, 255, 255))
    draw.text((100, 162), "Guiding humanitarian service with teamwork, honesty, and passion for community welfare", font=f_sub_lg, fill=(148, 163, 184))
    
    card_w = 540
    card_h = 320
    start_x = 100
    start_y = 225
    spacing_x = 45
    spacing_y = 35
    
    for idx, mem in enumerate(BOD_MEMBERS):
        col = idx % 3
        row = idx // 3
        bx = start_x + col * (card_w + spacing_x)
        by = start_y + row * (card_h + spacing_y)
        
        accent = mem["color"]
        draw.rounded_rectangle([bx, by, bx + card_w, by + card_h], radius=18, fill=(10, 26, 50), outline=accent, width=2)
        
        src_img = mem["photo"]
        pw, ph = 210, 290
        px, py = bx + 15, by + 15
        
        sw, sh = src_img.size
        t_ratio = pw / float(ph)
        s_ratio = sw / float(sh)
        if s_ratio > t_ratio:
            nw = int(sh * t_ratio)
            crop_box = ((sw - nw) // 2, 0, (sw + nw) // 2, sh)
        else:
            nh = int(sw / t_ratio)
            crop_box = (0, 0, sw, nh)
            
        cropped = src_img.crop(crop_box).resize((pw, ph), Image.Resampling.LANCZOS)
        p_mask = Image.new("L", (pw, ph), 0)
        ImageDraw.Draw(p_mask).rounded_rectangle([0, 0, pw, ph], radius=14, fill=255)
        canvas.paste(cropped, (px, py), p_mask)
        draw.rounded_rectangle([px, py, px + pw, py + ph], radius=14, outline=(255, 255, 255, 45), width=1)
        
        rx = px + pw + 22
        ry = by + 30
        
        b_bbox = f_badge.getbbox(mem["badge"])
        bw = b_bbox[2] - b_bbox[0] + 28
        bh = 30
        draw_badge(draw, [rx, ry, rx + bw, ry + bh], mem["badge"], f_badge, fill=(0, 45, 90), outline=accent, text_color=accent)
        
        ny = ry + bh + 18
        name_lines = textwrap.wrap(mem["name"], width=18)
        for nl_idx, nl in enumerate(name_lines):
            draw.text((rx, ny + nl_idx * 30), nl, font=f_title_sm, fill=(255, 255, 255))
        
        dy = ny + len(name_lines) * 30 + 10
        draw.text((rx, dy), mem["title"], font=f_sub_md, fill=accent)
        
        ay = by + card_h - 42
        draw.text((rx, ay), "RI District 3281 • Bangladesh", font=f_sub_sm, fill=(148, 163, 184))

    return canvas

# ==============================================================================
# CHAPTER 3: AZIMPUR MATERNITY HOSPITAL (32.0s - 47.0s, frames 960 - 1410)
# ==============================================================================
def render_chapter_3(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    draw_badge(draw, [100, 55, 560, 92], "HEALTHCARE FOCUS • AZIMPUR MATERNITY HOSPITAL", f_badge, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0))
    draw.text((100, 105), "Caring for Mothers & Newborns", font=f_title_lg, fill=(255, 255, 255))
    draw.text((100, 162), "Providing vital hospital equipment and 500+ nutritious food boxes directly into mothers' hands", font=f_sub_lg, fill=(148, 163, 184))
    
    card_w = 835
    card_h = 560
    card_y = 230
    
    p1_x = 100
    p1_resized = IMG_HOSPITAL.resize((card_w, card_h), Image.Resampling.LANCZOS)
    mask1 = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask1).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p1_resized, (p1_x, card_y), mask1)
    draw.rounded_rectangle([p1_x, card_y, p1_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([p1_x + 30, card_y + card_h - 85, p1_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p1_x + 50, card_y + card_h - 66), "Azimpur Maternity Hospital • Delivering Medical Equipment for Newborns", font=f_sub_md, fill=(255, 255, 255))
    
    p2_x = 985
    p2_resized = IMG_NUTRITION.resize((card_w, card_h), Image.Resampling.LANCZOS)
    canvas.paste(p2_resized, (p2_x, card_y), mask1)
    draw.rounded_rectangle([p2_x, card_y, p2_x + card_w, card_y + card_h], radius=22, outline=(0, 140, 255), width=3)
    
    draw.rounded_rectangle([p2_x + 30, card_y + card_h - 85, p2_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p2_x + 50, card_y + card_h - 66), "Nutritious Food Boxes • Direct In-Person Support for Mothers and Babies", font=f_sub_md, fill=(255, 255, 255))
    
    stat_y = 835
    draw.rounded_rectangle([100, stat_y, WIDTH - 100, stat_y + 155], radius=18, fill=(10, 26, 50), outline=(255, 184, 28), width=2)
    
    draw.text((150, stat_y + 25), "500+", font=f_stat_val, fill=(255, 184, 28))
    draw.text((150, stat_y + 95), "Nutritious Food and Care Boxes Delivered Directly", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([640, stat_y + 25, 640, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((700, stat_y + 25), "100%", font=f_stat_val, fill=(52, 211, 153))
    draw.text((700, stat_y + 95), "Direct Hands-On Support to Mothers in Hospital", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([1200, stat_y + 25, 1200, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((1260, stat_y + 25), "Dhaka, BD", font=f_stat_val, fill=(56, 189, 248))
    draw.text((1260, stat_y + 95), "Official Azimpur Government Maternity Hospital Partnership", font=f_stat_lbl, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# CHAPTER 4: SADIK MODEL SCHOOL SAFE WATER (47.0s - 61.0s, frames 1410 - 1830)
# ==============================================================================
def render_chapter_4(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    draw_badge(draw, [100, 55, 540, 92], "SAFE WATER PROJECT • SADIK MODEL SCHOOL", f_badge, fill=(0, 45, 90), outline=(0, 140, 255), text_color=(56, 189, 248))
    draw.text((100, 105), "Clean Drinking Water for Schoolchildren", font=f_title_lg, fill=(255, 255, 255))
    draw.text((100, 162), "Modern filtration plant keeping over 1,200 children healthy and safe from waterborne illness", font=f_sub_lg, fill=(148, 163, 184))
    
    card_w = 835
    card_h = 560
    card_y = 230
    
    p1_x = 100
    p1_resized = IMG_WATER.resize((card_w, card_h), Image.Resampling.LANCZOS)
    mask1 = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask1).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p1_resized, (p1_x, card_y), mask1)
    draw.rounded_rectangle([p1_x, card_y, p1_x + card_w, card_y + card_h], radius=22, outline=(0, 140, 255), width=3)
    
    draw.rounded_rectangle([p1_x + 30, card_y + card_h - 85, p1_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p1_x + 50, card_y + card_h - 66), "Sadik Model School • Children Enjoying Unlimited Clean Water Every Day", font=f_sub_md, fill=(255, 255, 255))
    
    p2_x = 985
    p2_resized = IMG_FILTER.resize((card_w, card_h), Image.Resampling.LANCZOS)
    canvas.paste(p2_resized, (p2_x, card_y), mask1)
    draw.rounded_rectangle([p2_x, card_y, p2_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([p2_x + 30, card_y + card_h - 85, p2_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p2_x + 50, card_y + card_h - 66), "Modern Multi-Stage Filters • Free from Arsenic, Germs & Unhealthy Contaminants", font=f_sub_md, fill=(255, 255, 255))
    
    stat_y = 835
    draw.rounded_rectangle([100, stat_y, WIDTH - 100, stat_y + 155], radius=18, fill=(10, 26, 50), outline=(0, 140, 255), width=2)
    
    draw.text((150, stat_y + 25), "1,200+", font=f_stat_val, fill=(56, 189, 248))
    draw.text((150, stat_y + 95), "Children Drinking Safe, Pure Water Every Single Day", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([640, stat_y + 25, 640, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((700, stat_y + 25), "100% Safe", font=f_stat_val, fill=(52, 211, 153))
    draw.text((700, stat_y + 95), "Arsenic-Free & Complete Protection from Water Sickness", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([1200, stat_y + 25, 1200, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((1260, stat_y + 25), "Tested", font=f_stat_val, fill=(255, 184, 28))
    draw.text((1260, stat_y + 95), "Regular Maintenance, Filter Changes & Water Quality Checks", font=f_stat_lbl, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# CHAPTER 5: DISASTER RELIEF & CLIMATE ACTION (61.0s - 76.0s, frames 1830 - 2280)
# ==============================================================================
def render_chapter_5(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    draw_badge(draw, [100, 55, 560, 92], "EMERGENCY AID & ENVIRONMENT • CLIMATE ACTION", f_badge, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 184, 28))
    draw.text((100, 105), "Winter Relief & Nationwide Green Drive", font=f_title_lg, fill=(255, 255, 255))
    draw.text((100, 162), "Sharing warmth with northern families in winter and planting native trees across Bangladesh", font=f_sub_lg, fill=(148, 163, 184))
    
    card_w = 835
    card_h = 560
    card_y = 230
    
    p1_x = 100
    p1_resized = IMG_WINTER.resize((card_w, card_h), Image.Resampling.LANCZOS)
    mask1 = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask1).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p1_resized, (p1_x, card_y), mask1)
    draw.rounded_rectangle([p1_x, card_y, p1_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([p1_x + 30, card_y + card_h - 85, p1_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p1_x + 50, card_y + card_h - 66), "Winter Relief • Delivering Warm Blankets Directly to Families in Need", font=f_sub_md, fill=(255, 255, 255))
    
    p2_x = 985
    p2_resized = IMG_TREE.resize((card_w, card_h), Image.Resampling.LANCZOS)
    canvas.paste(p2_resized, (p2_x, card_y), mask1)
    draw.rounded_rectangle([p2_x, card_y, p2_x + card_w, card_y + card_h], radius=22, outline=(52, 211, 153), width=3)
    
    draw.rounded_rectangle([p2_x + 30, card_y + card_h - 85, p2_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p2_x + 50, card_y + card_h - 66), "Green Bangladesh • Nationwide Tree Planting Campaign for Our Future", font=f_sub_md, fill=(255, 255, 255))
    
    stat_y = 835
    draw.rounded_rectangle([100, stat_y, WIDTH - 100, stat_y + 155], radius=18, fill=(10, 26, 50), outline=(255, 184, 28), width=2)
    
    draw.text((150, stat_y + 25), "5,000+", font=f_stat_val, fill=(255, 184, 28))
    draw.text((150, stat_y + 95), "Warm Winter Blankets Given to Vulnerable Families", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([640, stat_y + 25, 640, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((700, stat_y + 25), "64 Districts", font=f_stat_val, fill=(52, 211, 153))
    draw.text((700, stat_y + 95), "Nationwide Native Tree Planting Drives for a Greener Tomorrow", font=f_stat_lbl, fill=(226, 232, 240))
    
    draw.line([1200, stat_y + 25, 1200, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((1260, stat_y + 25), "Emergency", font=f_stat_val, fill=(56, 189, 248))
    draw.text((1260, stat_y + 95), "Rapid Monsoon Flood Help, Dry Food & Warm Community Iftar Drives", font=f_stat_lbl, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# CHAPTER 6: RADICAL TRANSPARENCY (76.0s - 90.0s, frames 2280 - 2700)
# ==============================================================================
def render_chapter_6(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    draw_badge(draw, [100, 55, 540, 92], "TRUST & HONESTY • 100% OPEN ACCOUNTS", f_badge, fill=(0, 45, 90), outline=(16, 185, 129), text_color=(52, 211, 153))
    draw.text((100, 105), "Honest, Open & Accountable to You", font=f_title_lg, fill=(255, 255, 255))
    draw.text((100, 162), "Every donation gets an instant digital receipt, and all expenses are published openly on our website", font=f_sub_lg, fill=(148, 163, 184))
    
    card_w = 760
    card_h = 660
    card_x = 100
    card_y = 230
    
    p_img = IMG_LEADERSHIP.resize((card_w, card_h), Image.Resampling.LANCZOS)
    mask = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p_img, (card_x, card_y), mask)
    draw.rounded_rectangle([card_x, card_y, card_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([card_x + 25, card_y + card_h - 85, card_x + card_w - 25, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((card_x + 45, card_y + card_h - 66), "District 3281 Annual Conference • 10 Consecutive Years Roll of Honour", font=f_sub_md, fill=(255, 255, 255))

    metrics = [
        ("20+", "Community Projects", "Health, clean water, schools, and disaster relief", (255, 184, 28)),
        ("106", "Verified Receipts", "Instant digital receipt ID for every single donor", (52, 211, 153)),
        ("49", "Open Expense Reports", "Zero waste; all project expenses published openly", (56, 189, 248)),
        ("66", "Dedicated Club Members", "Passionate volunteer professionals giving back", (244, 114, 182))
    ]
    
    grid_x = 900
    col_w = 445
    row_h = 240
    
    for i, (val, lbl, note, col) in enumerate(metrics):
        col_idx = i % 2
        row_idx = i // 2
        bx = grid_x + col_idx * (col_w + 30)
        by = card_y + row_idx * (row_h + 20)
        
        draw.rounded_rectangle([bx, by, bx + col_w, by + row_h], radius=18, fill=(10, 26, 50), outline=(255, 255, 255, 40), width=2)
        
        draw.text((bx + 30, by + 28), val, font=f_stat_val, fill=col)
        draw.text((bx + 30, by + 98), lbl, font=f_title_sm, fill=(255, 255, 255))
        draw.text((bx + 30, by + 148), note, font=f_sub_sm, fill=(148, 163, 184))
        
        draw.rounded_rectangle([bx + col_w - 55, by + 30, bx + col_w - 25, by + 60], radius=15, fill=(0, 45, 90), outline=col, width=2)
        draw.text((bx + col_w - 47, by + 34), "✓", font=f_badge, fill=col)

    cta_y = card_y + row_h * 2 + 55
    draw.rounded_rectangle([grid_x, cta_y, WIDTH - 100, cta_y + 125], radius=18, fill=(0, 93, 170), outline=(255, 184, 28), width=2)
    
    draw.text((grid_x + 35, cta_y + 24), "Visit Our Website: www.shantinagarfoundation.org", font=f_title_sm, fill=(255, 184, 28))
    draw.text((grid_x + 35, cta_y + 75), "Rotary Club of Shantinagar Dhaka • House 12, Road 5, Shanti Nagar, Dhaka-1217", font=f_sub_md, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# CHAPTER 7: CIVIC PARTNERSHIP & CONCLUSION (90.0s - 104.0s, frames 2700 - 3120)
# ==============================================================================
def render_chapter_7(frame_idx):
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    logo_sz = 140
    logo_resized = LOGO_IMG.resize((logo_sz, logo_sz), Image.Resampling.LANCZOS)
    canvas.paste(logo_resized, ((WIDTH - logo_sz) // 2, 130), logo_resized)
    
    draw_badge(draw, [(WIDTH - 460) // 2, 295, (WIDTH + 460) // 2, 335], "ROTARY INTERNATIONAL DISTRICT 3281", f_badge, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0))
    
    t1 = "Service Above Self • Make a Difference With Us"
    bbox1 = f_hero.getbbox(t1)
    draw.text(((WIDTH - (bbox1[2] - bbox1[0])) // 2, 360), t1, font=f_hero, fill=(255, 255, 255))
    
    t2 = "Join our humanitarian journey and help bring real care and hope to families across Bangladesh"
    bbox2 = f_sub_lg.getbbox(t2)
    draw.text(((WIDTH - (bbox2[2] - bbox2[0])) // 2, 435), t2, font=f_sub_lg, fill=(203, 213, 225))
    
    card_w = 980
    card_h = 250
    card_x = (WIDTH - card_w) // 2
    card_y = 520
    draw.rounded_rectangle([card_x, card_y, card_x + card_w, card_y + card_h], radius=24, fill=(10, 26, 50), outline=(255, 184, 28), width=3)
    
    c1 = "Official Website:  www.shantinagarfoundation.org"
    draw.text((card_x + 60, card_y + 40), c1, font=f_title_sm, fill=(255, 184, 28))
    
    c2 = "Club Office:  House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh"
    draw.text((card_x + 60, card_y + 105), c2, font=f_sub_lg, fill=(241, 245, 249))
    
    c3 = "Join & Support:  contact@rotaryshantinagardhaka.org"
    draw.text((card_x + 60, card_y + 165), c3, font=f_sub_lg, fill=(56, 189, 248))
    
    bot_motto = "Rotary Club of Shantinagar Dhaka • Chartered 2005"
    bb_motto = f_title_sm.getbbox(bot_motto)
    draw.text(((WIDTH - (bb_motto[2] - bb_motto[0])) // 2, 850), bot_motto, font=f_title_sm, fill=(255, 184, 28))

    return canvas

def get_scene_frame(frame_idx):
    FADE_LEN = 15
    # Ch 1: 0 - 480 (0.0s - 16.0s)
    if frame_idx < 465:
        return render_chapter_1(frame_idx)
    elif frame_idx <= 480:
        alpha = (frame_idx - 465) / float(FADE_LEN)
        return Image.blend(render_chapter_1(frame_idx), render_chapter_2(frame_idx), alpha)
    # Ch 2: 480 - 960 (16.0s - 32.0s)
    elif frame_idx < 945:
        return render_chapter_2(frame_idx)
    elif frame_idx <= 960:
        alpha = (frame_idx - 945) / float(FADE_LEN)
        return Image.blend(render_chapter_2(frame_idx), render_chapter_3(frame_idx), alpha)
    # Ch 3: 960 - 1410 (32.0s - 47.0s)
    elif frame_idx < 1395:
        return render_chapter_3(frame_idx)
    elif frame_idx <= 1410:
        alpha = (frame_idx - 1395) / float(FADE_LEN)
        return Image.blend(render_chapter_3(frame_idx), render_chapter_4(frame_idx), alpha)
    # Ch 4: 1410 - 1830 (47.0s - 61.0s)
    elif frame_idx < 1815:
        return render_chapter_4(frame_idx)
    elif frame_idx <= 1830:
        alpha = (frame_idx - 1815) / float(FADE_LEN)
        return Image.blend(render_chapter_4(frame_idx), render_chapter_5(frame_idx), alpha)
    # Ch 5: 1830 - 2280 (61.0s - 76.0s)
    elif frame_idx < 2265:
        return render_chapter_5(frame_idx)
    elif frame_idx <= 2280:
        alpha = (frame_idx - 2265) / float(FADE_LEN)
        return Image.blend(render_chapter_5(frame_idx), render_chapter_6(frame_idx), alpha)
    # Ch 6: 2280 - 2700 (76.0s - 90.0s)
    elif frame_idx < 2685:
        return render_chapter_6(frame_idx)
    elif frame_idx <= 2700:
        alpha = (frame_idx - 2685) / float(FADE_LEN)
        return Image.blend(render_chapter_6(frame_idx), render_chapter_7(frame_idx), alpha)
    # Ch 7: 2700 - 3120 (90.0s - 104.0s)
    else:
        return render_chapter_7(frame_idx)

def main():
    print(f"🎬 Starting Detailed English Render: 1920x1080 @ {FPS}fps, {TOTAL_FRAMES} frames (104.0s) with Relaxed Aman Voiceover")
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    os.makedirs("work/en/v2", exist_ok=True)
    
    print("📸 Generating poster frame (brag.jpg)...")
    poster_img = get_scene_frame(0)
    poster_img.save(POSTER_PATH, "JPEG", quality=95)
    print(f"✅ Saved poster to {POSTER_PATH}")
    
    cmd = [
        "/opt/homebrew/bin/ffmpeg",
        "-y",
        "-f", "rawvideo",
        "-vcodec", "rawvideo",
        "-s", f"{WIDTH}x{HEIGHT}",
        "-pix_fmt", "rgb24",
        "-r", str(FPS),
        "-i", "-",
        "-i", AUDIO_PATH,
        "-t", "104.0",
        "-map", "0:v",
        "-map", "1:a",
        "-c:v", "libx264",
        "-preset", "medium",
        "-crf", "18",
        "-pix_fmt", "yuv420p",
        "-c:a", "aac",
        "-b:a", "192k",
        FINAL_VIDEO_PATH
    ]
    
    print(f"🚀 Running ffmpeg encoding pipeline...")
    proc = subprocess.Popen(cmd, stdin=subprocess.PIPE, stdout=subprocess.DEVNULL, stderr=subprocess.PIPE)
    
    for f in range(TOTAL_FRAMES):
        if f % 300 == 0:
            print(f"   ⏳ Rendering frame {f}/{TOTAL_FRAMES} ({(f/TOTAL_FRAMES)*100:.1f}% - {f/FPS:.1f}s)...")
        frame_img = get_scene_frame(f)
        proc.stdin.write(frame_img.tobytes())
        
    proc.stdin.close()
    stderr = proc.stderr.read().decode()
    proc.wait()
    
    if proc.returncode != 0:
        print(f"❌ ffmpeg error:\n{stderr}")
        sys.exit(1)
        
    print(f"🎉 Successfully rendered detailed documentary video: {FINAL_VIDEO_PATH}")
    filesize_mb = os.path.getsize(FINAL_VIDEO_PATH) / (1024 * 1024)
    print(f"   Size: {filesize_mb:.2f} MB")

if __name__ == "__main__":
    main()
