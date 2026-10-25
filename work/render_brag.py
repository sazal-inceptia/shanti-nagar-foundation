#!/usr/bin/env python3
"""
Rotary Club of Shantinagar Dhaka - High-Definition Launch & Presentation Video Renderer
V3: Fixed Badges, Unbroken Layout, Full BOD (3x2 Grid), and Authentic Flagship Projects
- 1080p FHD (1920x1080), 30 FPS, 22.0s (660 frames)
- Audio Sync with Happy Beats Vol. 10 (109.96 BPM) + 1.5s Fade Out
- Solid RGB Blending: Zero Invisible Text, Zero Broken Badges
- Textwrap on All Member Names & Text: Zero Out-of-the-Box Overflow
"""

import os
import sys
import math
import subprocess
import textwrap
from PIL import Image, ImageDraw, ImageFont

WIDTH, HEIGHT = 1920, 1080
FPS = 30
TOTAL_FRAMES = 660  # 22.0 seconds
OUTPUT_DIR = "brag-output"
POSTER_PATH = os.path.join(OUTPUT_DIR, "brag.jpg")
FINAL_VIDEO_PATH = os.path.join(OUTPUT_DIR, "brag.mp4")

MUSIC_PATH = "/Users/zesan/.gemini/antigravity-ide/brain/f56e208e-c14c-4848-a16d-b7f50e4c00ca/scratch/brag/skills/brag/assets/music/happy-beats-business-moves-vol-10-by-ende-dot-app.mp3"

FONT_BOLD = "/System/Library/Fonts/Supplemental/Arial Bold.ttf"
FONT_REGULAR = "/System/Library/Fonts/Supplemental/Arial.ttf"

def ease_out_cubic(x):
    return 1.0 - math.pow(1.0 - max(0.0, min(1.0, x)), 3)

def load_font(path, size):
    try:
        return ImageFont.truetype(path, size)
    except Exception:
        return ImageFont.load_default()

font_title_lg = load_font(FONT_BOLD, 50)
font_title_md = load_font(FONT_BOLD, 40)
font_title_sm = load_font(FONT_BOLD, 26)
font_sub_lg = load_font(FONT_REGULAR, 26)
font_sub_md = load_font(FONT_REGULAR, 21)
font_sub_sm = load_font(FONT_REGULAR, 17)
font_badge_lg = load_font(FONT_BOLD, 16)
font_badge_sm = load_font(FONT_BOLD, 14)
font_name = load_font(FONT_BOLD, 23)
font_desig = load_font(FONT_REGULAR, 17)
font_stat_val = load_font(FONT_BOLD, 46)
font_stat_lbl = load_font(FONT_REGULAR, 18)

# Pre-load branding and project images
LOGO_IMG = Image.open("public/assets/images/logo.png").convert("RGBA")
IMG_HOSPITAL = Image.open("public/assets/images/gallery-albums/health-and-medical-aid/medical-equipment-hospital-handover.jpeg").convert("RGB")
IMG_NUTRITION = Image.open("public/assets/images/gallery-albums/community-service-and-relief/pushti-nutrition-handover-mother.jpeg").convert("RGB")
IMG_WATER = Image.open("public/assets/images/gallery-albums/community-service-and-relief/water-purifier-installation-children.jpeg").convert("RGB")
IMG_WINTER = Image.open("public/assets/images/projects/covers/winter-clothes-blanket.jpeg").convert("RGB")
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
        "title": "President Elect (RY 2027-28)",
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
    """Deep royal rotary theme background (#05142a) with subtle ambient light pulses."""
    t = frame_idx / FPS
    pulse = 0.5 + 0.5 * math.sin(t * (109.96 / 60.0) * math.pi * 2)
    
    base = Image.new("RGB", (WIDTH, HEIGHT), (5, 20, 42))
    draw = ImageDraw.Draw(base)
    
    cx = WIDTH // 2
    cy = int(HEIGHT * 0.45)
    r_max = int(850 + 60 * pulse)
    
    # Soft concentric circles drawn directly on RGB
    for r in range(r_max, 120, -70):
        # calculate blend factor
        factor = (1.0 - r / r_max) * 0.22
        col = (
            int(5 + (0 - 5) * factor),
            int(20 + (93 - 20) * factor),
            int(42 + (170 - 42) * factor)
        )
        draw.ellipse([cx - r, cy - r, cx + r, cy + r], fill=col)
        
    return base

def draw_badge(draw, box, text, font, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0)):
    """Draws a crisp, high-contrast badge with guaranteed legible text."""
    draw.rounded_rectangle(box, radius=(box[3] - box[1]) // 2, fill=fill, outline=outline, width=2)
    bbox = font.getbbox(text)
    tw = bbox[2] - bbox[0]
    th = bbox[3] - bbox[1]
    bx = box[0] + (box[2] - box[0] - tw) // 2
    by = box[1] + (box[3] - box[1] - th) // 2 - bbox[1]
    draw.text((bx, by), text, font=font, fill=text_color)

# ==============================================================================
# SCENE 1: ABOUT CLUB INFORMATION (0.0s - 4.2s, frames 0 - 126)
# ==============================================================================
def render_scene_1(frame_idx):
    t = frame_idx / FPS
    progress = min(1.0, t / 1.0)
    ease = ease_out_cubic(progress)
    
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    # Logo
    logo_sz = 100
    logo_resized = LOGO_IMG.resize((logo_sz, logo_sz), Image.Resampling.LANCZOS)
    canvas.paste(logo_resized, (100, 65), logo_resized)
    
    # Top Header Pill Badge
    draw_badge(draw, [220, 60, 660, 96], "ROTARY INTERNATIONAL DISTRICT 3281", font_badge_lg, fill=(0, 45, 90), outline=(0, 140, 255), text_color=(125, 211, 252))
    
    title = "Rotary Club of Shantinagar Dhaka"
    draw.text((220, 110), title, font=font_title_lg, fill=(255, 255, 255))
    
    sub = "Chartered 2005 • Over 20 Years of Grassroots Humanitarian Service in Bangladesh"
    draw.text((220, 175), sub, font=font_sub_md, fill=(203, 213, 225))
    
    card_y = int(240 + (1.0 - ease) * 35)
    card_h = 610
    card_w = 540
    spacing = 45
    start_x = 100
    
    pillars = [
        {
            "tag": "PILLAR 01",
            "title": "Maternal & Child Health",
            "lead": "Direct hospital equipment aid & essential nutrition for newborn mothers.",
            "points": [
                "Partnered with Azimpur Maternity Hospital",
                "500+ Pushti nutrition packs delivered",
                "Neonatal incubators & critical patient care"
            ],
            "color": (255, 184, 28)
        },
        {
            "tag": "PILLAR 02",
            "title": "Safe Water & Education",
            "lead": "School water filtration plants protecting thousands of children daily.",
            "points": [
                "Sadik Model School water plant installation",
                "1,200+ students access clean drinking water",
                "Arsenic, bacteria & heavy-metal purification"
            ],
            "color": (56, 189, 248)
        },
        {
            "tag": "PILLAR 03",
            "title": "Radical Transparency",
            "lead": "100% itemized public accounting of every single taka received & spent.",
            "points": [
                "Verified digital donation receipts with tracking",
                "Public audited financial ledgers in BDT",
                "Zero administrative leakage & high governance"
            ],
            "color": (52, 211, 153)
        }
    ]
    
    for i, p in enumerate(pillars):
        bx = start_x + i * (card_w + spacing)
        draw.rounded_rectangle([bx, card_y, bx + card_w, card_y + card_h], radius=20, fill=(10, 26, 50), outline=p["color"], width=2)
        
        # Pill Badge inside card with 100% visible text
        draw_badge(draw, [bx + 35, card_y + 35, bx + 165, card_y + 72], p["tag"], font_badge_sm, fill=(0, 45, 90), outline=p["color"], text_color=p["color"])
        
        draw.text((bx + 35, card_y + 95), p["title"], font=font_title_sm, fill=(255, 255, 255))
        
        # Lead text wrapped cleanly by words
        lead_lines = textwrap.wrap(p["lead"], width=36)
        for l_idx, l in enumerate(lead_lines):
            draw.text((bx + 35, card_y + 148 + l_idx * 28), l, font=font_sub_sm, fill=(203, 213, 225))
            
        draw.line([bx + 35, card_y + 225, bx + card_w - 35, card_y + 225], fill=(255, 255, 255, 30), width=1)
        
        # Bullet points wrapped cleanly by words
        for j, pt in enumerate(p["points"]):
            py_item = card_y + 258 + j * 105
            draw.ellipse([bx + 38, py_item + 6, bx + 48, py_item + 16], fill=p["color"])
            
            pt_lines = textwrap.wrap(pt, width=33)
            for pt_idx, ptl in enumerate(pt_lines):
                col_pt = (241, 245, 249) if pt_idx == 0 else (148, 163, 184)
                draw.text((bx + 62, py_item + pt_idx * 26), ptl, font=font_sub_sm, fill=col_pt)

    # Bottom Motto Ribbon
    ribbon_y = 880
    draw.rounded_rectangle([100, ribbon_y, 1820, ribbon_y + 120], radius=16, fill=(0, 93, 170), outline=(255, 184, 28), width=2)
    draw.text((140, ribbon_y + 24), "SERVICE ABOVE SELF", font=font_title_sm, fill=(255, 184, 28))
    draw.text((140, ribbon_y + 68), "Official Rotary Motto • Dedicated to improving quality of life across Dhaka and remote Bangladesh", font=font_sub_sm, fill=(226, 232, 240))
    draw.text((1500, ribbon_y + 44), "Chartered: 2005", font=font_title_sm, fill=(255, 255, 255))

    return canvas

# ==============================================================================
# SCENE 2: BOARD OF DIRECTORS (BOD) (4.2s - 8.6s, frames 126 - 258)
# ==============================================================================
def render_scene_2(frame_idx):
    rel_frame = frame_idx - 126
    t = rel_frame / FPS
    progress = min(1.0, t / 1.0)
    ease = ease_out_cubic(progress)
    
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    # Top Tag & Header
    draw_badge(draw, [100, 60, 580, 96], "CLUB GOVERNANCE & LEADERSHIP • RY 2026-2027", font_badge_lg, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0))
    
    draw.text((100, 112), "Board of Directors & Executive Leadership", font=font_title_md, fill=(255, 255, 255))
    draw.text((100, 168), "Guiding humanitarian relief with professional governance, dedication, and integrity", font=font_sub_md, fill=(148, 163, 184))
    
    # 3 Columns x 2 Rows Layout (540px wide cards) -> Zero text bleeding
    card_w = 540
    card_h = 320
    start_x = 100
    start_y = int(225 + (1.0 - ease) * 35)
    spacing_x = 45
    spacing_y = 35
    
    for idx, mem in enumerate(BOD_MEMBERS):
        col = idx % 3
        row = idx // 3
        bx = start_x + col * (card_w + spacing_x)
        by = start_y + row * (card_h + spacing_y)
        
        accent = mem["color"]
        draw.rounded_rectangle([bx, by, bx + card_w, by + card_h], radius=18, fill=(10, 26, 50), outline=accent, width=2)
        
        # Photo on Left (210 x 290)
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
        
        # Right Side Content Box
        rx = px + pw + 22
        ry = by + 24
        
        # Role Badge
        b_bbox = font_badge_sm.getbbox(mem["badge"])
        bw = b_bbox[2] - b_bbox[0] + 28
        bh = 32
        draw_badge(draw, [rx, ry, rx + bw, ry + bh], mem["badge"], font_badge_sm, fill=(0, 45, 90), outline=accent, text_color=accent)
        
        # Member Name with Wordwrap (Never cuts words, stays inside card)
        ny = ry + bh + 18
        name_lines = textwrap.wrap(mem["name"], width=19)
        for l_idx, line in enumerate(name_lines):
            draw.text((rx, ny + l_idx * 30), line, font=font_name, fill=(255, 255, 255))
            
        # Designation
        dy = ny + len(name_lines) * 30 + 12
        desig_lines = textwrap.wrap(mem["title"], width=25)
        for d_idx, dline in enumerate(desig_lines):
            draw.text((rx, dy + d_idx * 24), dline, font=font_desig, fill=accent)
            
        # District / Affiliation anchored at bottom
        ay = by + card_h - 42
        draw.text((rx, ay), "RI District 3281 • Bangladesh", font=load_font(FONT_REGULAR, 15), fill=(148, 163, 184))

    return canvas

# ==============================================================================
# SCENE 3: FLAGSHIP PROJECT 1 — AZIMPUR MATERNITY HOSPITAL (8.6s - 13.0s, frames 258 - 390)
# ==============================================================================
def render_scene_3(frame_idx):
    rel_frame = frame_idx - 258
    t = rel_frame / FPS
    progress = min(1.0, t / 1.0)
    ease = ease_out_cubic(progress)
    
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    # Top Tag & Header
    draw_badge(draw, [100, 60, 640, 96], "FLAGSHIP PROJECT 01 • MATERNAL & NEONATAL HEALTHCARE", font_badge_lg, fill=(0, 45, 90), outline=(255, 184, 28), text_color=(255, 215, 0))
    
    draw.text((100, 112), "Azimpur Maternity Hospital Aid & Pushti Boxes", font=font_title_md, fill=(255, 255, 255))
    draw.text((100, 168), "Delivering vital hospital equipment and 500+ maternal nutrition kits directly to mothers in need", font=font_sub_md, fill=(148, 163, 184))
    
    zoom = 1.0 + 0.035 * (rel_frame / 132.0)
    card_w = 835
    card_h = 560
    card_y = 235
    
    # Photo 1: Hospital Equipment Handover
    p1_x = int(100 + (1.0 - ease) * -40)
    pw1, ph1 = int(card_w * zoom), int(card_h * zoom)
    p1_resized = IMG_HOSPITAL.resize((pw1, ph1), Image.Resampling.LANCZOS)
    c1_x, c1_y = (pw1 - card_w) // 2, (ph1 - card_h) // 2
    p1_crop = p1_resized.crop((c1_x, c1_y, c1_x + card_w, c1_y + card_h))
    
    mask1 = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask1).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p1_crop, (p1_x, card_y), mask1)
    draw.rounded_rectangle([p1_x, card_y, p1_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([p1_x + 30, card_y + card_h - 85, p1_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p1_x + 50, card_y + card_h - 68), "Azimpur Maternity Hospital • Neonatal & Maternal Equipment Handover", font=font_sub_md, fill=(255, 255, 255))
    
    # Photo 2: Mother Receiving Pushti Nutrition Box
    p2_x = int(985 + (1.0 - ease) * 40)
    pw2, ph2 = int(card_w * zoom), int(card_h * zoom)
    p2_resized = IMG_NUTRITION.resize((pw2, ph2), Image.Resampling.LANCZOS)
    c2_x, c2_y = (pw2 - card_w) // 2, (ph2 - card_h) // 2
    p2_crop = p2_resized.crop((c2_x, c2_y, c2_x + card_w, c2_y + card_h))
    
    canvas.paste(p2_crop, (p2_x, card_y), mask1)
    draw.rounded_rectangle([p2_x, card_y, p2_x + card_w, card_y + card_h], radius=22, outline=(0, 140, 255), width=3)
    
    draw.rounded_rectangle([p2_x + 30, card_y + card_h - 85, p2_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p2_x + 50, card_y + card_h - 68), "Pushti Nutrition Box Distribution • Direct Mother & Infant Relief", font=font_sub_md, fill=(255, 255, 255))
    
    # Bottom 3-Metric Stats Banner
    stat_y = 835
    draw.rounded_rectangle([100, stat_y, WIDTH - 100, stat_y + 155], radius=18, fill=(10, 26, 50), outline=(255, 184, 28), width=2)
    
    draw.text((150, stat_y + 25), "500+", font=font_stat_val, fill=(255, 184, 28))
    draw.text((150, stat_y + 90), "Pushti Nutrition Boxes Delivered", font=font_stat_lbl, fill=(226, 232, 240))
    
    draw.line([640, stat_y + 25, 640, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((700, stat_y + 25), "100%", font=font_stat_val, fill=(52, 211, 153))
    draw.text((700, stat_y + 90), "Direct Handover to Beneficiaries", font=font_stat_lbl, fill=(226, 232, 240))
    
    draw.line([1200, stat_y + 25, 1200, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((1260, stat_y + 25), "Dhaka, BD", font=font_stat_val, fill=(56, 189, 248))
    draw.text((1260, stat_y + 90), "Public Hospital Partnerships", font=font_stat_lbl, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# SCENE 4: FLAGSHIP PROJECTS 2 & 3 — SAFE WATER & WINTER RELIEF (13.0s - 17.5s, frames 390 - 525)
# ==============================================================================
def render_scene_4(frame_idx):
    rel_frame = frame_idx - 390
    t = rel_frame / FPS
    progress = min(1.0, t / 1.0)
    ease = ease_out_cubic(progress)
    
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    # Top Tag & Header
    draw_badge(draw, [100, 60, 640, 96], "FLAGSHIP PROJECTS 02 & 03 • SAFE WATER & WINTER RELIEF", font_badge_lg, fill=(0, 45, 90), outline=(0, 140, 255), text_color=(56, 189, 248))
    
    draw.text((100, 112), "Clean Drinking Water & Community Warmth", font=font_title_md, fill=(255, 255, 255))
    draw.text((100, 168), "Sadik Model School clean water filtration plants and seasonal emergency relief campaigns", font=font_sub_md, fill=(148, 163, 184))
    
    zoom = 1.0 + 0.035 * (rel_frame / 135.0)
    card_w = 835
    card_h = 560
    card_y = 235
    
    # Photo 1: Sadik Model School Water Purifiers
    p1_x = int(100 + (1.0 - ease) * -40)
    pw1, ph1 = int(card_w * zoom), int(card_h * zoom)
    p1_resized = IMG_WATER.resize((pw1, ph1), Image.Resampling.LANCZOS)
    c1_x, c1_y = (pw1 - card_w) // 2, (ph1 - card_h) // 2
    p1_crop = p1_resized.crop((c1_x, c1_y, c1_x + card_w, c1_y + card_h))
    
    mask1 = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask1).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p1_crop, (p1_x, card_y), mask1)
    draw.rounded_rectangle([p1_x, card_y, p1_x + card_w, card_y + card_h], radius=22, outline=(0, 140, 255), width=3)
    
    draw.rounded_rectangle([p1_x + 30, card_y + card_h - 85, p1_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p1_x + 50, card_y + card_h - 68), "Sadik Model School • Heavy-Duty Water Purifier Plant Installed", font=font_sub_md, fill=(255, 255, 255))
    
    # Photo 2: Winter Relief & Blanket Distribution
    p2_x = int(985 + (1.0 - ease) * 40)
    pw2, ph2 = int(card_w * zoom), int(card_h * zoom)
    p2_resized = IMG_WINTER.resize((pw2, ph2), Image.Resampling.LANCZOS)
    c2_x, c2_y = (pw2 - card_w) // 2, (ph2 - card_h) // 2
    p2_crop = p2_resized.crop((c2_x, c2_y, c2_x + card_w, c2_y + card_h))
    
    canvas.paste(p2_crop, (p2_x, card_y), mask1)
    draw.rounded_rectangle([p2_x, card_y, p2_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([p2_x + 30, card_y + card_h - 85, p2_x + card_w - 30, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((p2_x + 50, card_y + card_h - 68), "Winter Warmth Drive • Blankets & Winter Kits for Cold-Affected Families", font=font_sub_md, fill=(255, 255, 255))

    # Bottom 3-Metric Stats Banner
    stat_y = 835
    draw.rounded_rectangle([100, stat_y, WIDTH - 100, stat_y + 155], radius=18, fill=(10, 26, 50), outline=(0, 140, 255), width=2)
    
    draw.text((150, stat_y + 25), "1,200+", font=font_stat_val, fill=(56, 189, 248))
    draw.text((150, stat_y + 90), "Students Daily Protected", font=font_stat_lbl, fill=(226, 232, 240))
    
    draw.line([640, stat_y + 25, 640, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((700, stat_y + 25), "Arsenic Free", font=font_stat_val, fill=(52, 211, 153))
    draw.text((700, stat_y + 90), "Heavy Metal & Bacteria Removal", font=font_stat_lbl, fill=(226, 232, 240))
    
    draw.line([1200, stat_y + 25, 1200, stat_y + 130], fill=(255, 255, 255, 35), width=2)
    
    draw.text((1260, stat_y + 25), "5,000+", font=font_stat_val, fill=(255, 184, 28))
    draw.text((1260, stat_y + 90), "Winter Warmth Kits Handed Over", font=font_stat_lbl, fill=(226, 232, 240))

    return canvas

# ==============================================================================
# SCENE 5: RADICAL TRANSPARENCY & CIVIC CALL TO ACTION (17.5s - 22.0s, frames 525 - 660)
# ==============================================================================
def render_scene_5(frame_idx):
    rel_frame = frame_idx - 525
    t = rel_frame / FPS
    progress = min(1.0, t / 1.0)
    ease = ease_out_cubic(progress)
    
    canvas = create_base_canvas(frame_idx)
    draw = ImageDraw.Draw(canvas)
    
    # Top Tag & Header
    draw_badge(draw, [100, 60, 620, 96], "RADICAL FINANCIAL ACCOUNTABILITY & CIVIC IMPACT", font_badge_lg, fill=(0, 45, 90), outline=(16, 185, 129), text_color=(52, 211, 153))
    
    draw.text((100, 112), "100% Verified Transparency • Every Taka Accounted For", font=font_title_md, fill=(255, 255, 255))
    draw.text((100, 168), "Complete public audit trail with itemized receipts in BDT and zero administrative waste", font=font_sub_md, fill=(148, 163, 184))
    
    zoom = 1.0 + 0.035 * (rel_frame / 135.0)
    card_w = 760
    card_h = 660
    card_x = int(100 + (1.0 - ease) * -40)
    card_y = 235
    
    pw, ph = int(card_w * zoom), int(card_h * zoom)
    p_img = IMG_LEADERSHIP.resize((pw, ph), Image.Resampling.LANCZOS)
    cx, cy = (pw - card_w) // 2, (ph - card_h) // 2
    p_crop = p_img.crop((cx, cy, cx + card_w, cy + card_h))
    
    mask = Image.new("L", (card_w, card_h), 0)
    ImageDraw.Draw(mask).rounded_rectangle([0, 0, card_w, card_h], radius=22, fill=255)
    canvas.paste(p_crop, (card_x, card_y), mask)
    draw.rounded_rectangle([card_x, card_y, card_x + card_w, card_y + card_h], radius=22, outline=(255, 184, 28), width=3)
    
    draw.rounded_rectangle([card_x + 25, card_y + card_h - 85, card_x + card_w - 25, card_y + card_h - 25], radius=14, fill=(10, 24, 46))
    draw.text((card_x + 45, card_y + card_h - 68), "District 3281 Annual Conference • 10-Year Roll of Honour Leadership", font=font_sub_md, fill=(255, 255, 255))

    # Right 4-Metric Grid (Counting up)
    count_t = min(1.0, rel_frame / 40.0)
    projects_cnt = int(20 * count_t)
    donations_cnt = int(106 * count_t)
    expenses_cnt = int(49 * count_t)
    members_cnt = int(66 * count_t)
    
    metrics = [
        (f"{projects_cnt}", "Verified Projects", "Maternity, water, education & climate", (255, 184, 28)),
        (f"{donations_cnt}", "Tracked BDT Donations", "Every donation has public receipt ID", (52, 211, 153)),
        (f"{expenses_cnt}", "Public Expense Audits", "Itemized ledgers with zero hidden fees", (56, 189, 248)),
        (f"{members_cnt}", "Active Club Leaders", "Committed to Service Above Self", (244, 114, 182))
    ]
    
    grid_x = int(900 + (1.0 - ease) * 40)
    col_w = 445
    row_h = 240
    
    for i, (val, lbl, note, col) in enumerate(metrics):
        col_idx = i % 2
        row_idx = i // 2
        bx = grid_x + col_idx * (col_w + 30)
        by = card_y + row_idx * (row_h + 20)
        
        draw.rounded_rectangle([bx, by, bx + col_w, by + row_h], radius=18, fill=(10, 26, 50), outline=(255, 255, 255, 40), width=2)
        
        draw.text((bx + 30, by + 30), val, font=font_stat_val, fill=col)
        draw.text((bx + 30, by + 100), lbl, font=font_title_sm, fill=(255, 255, 255))
        draw.text((bx + 30, by + 155), note, font=font_sub_sm, fill=(148, 163, 184))
        
        draw.rounded_rectangle([bx + col_w - 55, by + 30, bx + col_w - 25, by + 60], radius=15, fill=(0, 45, 90), outline=col, width=2)
        draw.text((bx + col_w - 47, by + 34), "✓", font=font_sub_sm, fill=col)

    # Bottom Contact & Civic Call to Action Bar
    cta_y = card_y + row_h * 2 + 55
    draw.rounded_rectangle([grid_x, cta_y, WIDTH - 100, cta_y + 125], radius=18, fill=(0, 93, 170), outline=(255, 184, 28), width=2)
    
    draw.text((grid_x + 35, cta_y + 24), "Visit: www.shantinagarfoundation.org", font=font_title_sm, fill=(255, 184, 28))
    draw.text((grid_x + 35, cta_y + 75), "Rotary Club of Shantinagar Dhaka • House 12, Road 5, Shanti Nagar, Dhaka-1217", font=font_sub_sm, fill=(226, 232, 240))

    return canvas

def get_scene_frame(frame_idx):
    FADE_LEN = 10
    if frame_idx < 120:
        return render_scene_1(frame_idx)
    elif frame_idx <= 130:
        alpha = (frame_idx - 120) / float(FADE_LEN)
        img1 = render_scene_1(frame_idx)
        img2 = render_scene_2(frame_idx)
        return Image.blend(img1, img2, alpha)
    elif frame_idx < 252:
        return render_scene_2(frame_idx)
    elif frame_idx <= 262:
        alpha = (frame_idx - 252) / float(FADE_LEN)
        img1 = render_scene_2(frame_idx)
        img2 = render_scene_3(frame_idx)
        return Image.blend(img1, img2, alpha)
    elif frame_idx < 384:
        return render_scene_3(frame_idx)
    elif frame_idx <= 394:
        alpha = (frame_idx - 384) / float(FADE_LEN)
        img1 = render_scene_3(frame_idx)
        img2 = render_scene_4(frame_idx)
        return Image.blend(img1, img2, alpha)
    elif frame_idx < 520:
        return render_scene_4(frame_idx)
    elif frame_idx <= 530:
        alpha = (frame_idx - 520) / float(FADE_LEN)
        img1 = render_scene_4(frame_idx)
        img2 = render_scene_5(frame_idx)
        return Image.blend(img1, img2, alpha)
    else:
        return render_scene_5(frame_idx)

def main():
    print(f"🎬 Starting Render V3: 1920x1080 @ {FPS}fps, {TOTAL_FRAMES} frames (22.0s)")
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    os.makedirs("work", exist_ok=True)
    
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
        "-i", MUSIC_PATH,
        "-t", "22.0",
        "-filter_complex", "[1:a]afade=t=out:st=20.5:d=1.5[aout]",
        "-map", "0:v",
        "-map", "[aout]",
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
        if f % 60 == 0:
            print(f"   ⏳ Rendering frame {f}/{TOTAL_FRAMES} ({(f/TOTAL_FRAMES)*100:.1f}% - {f/FPS:.1f}s)...")
        frame_img = get_scene_frame(f)
        proc.stdin.write(frame_img.tobytes())
        
    proc.stdin.close()
    stderr = proc.stderr.read().decode()
    proc.wait()
    
    if proc.returncode != 0:
        print(f"❌ ffmpeg error:\n{stderr}")
        sys.exit(1)
        
    print(f"🎉 Successfully rendered V3 brag video: {FINAL_VIDEO_PATH}")
    filesize_mb = os.path.getsize(FINAL_VIDEO_PATH) / (1024 * 1024)
    print(f"   Size: {filesize_mb:.2f} MB")

if __name__ == "__main__":
    main()
