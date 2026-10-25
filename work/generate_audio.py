#!/usr/bin/env python3
"""
Rotary Club of Shantinagar Dhaka - Audio Voiceover Generation Script
====================================================================
Use this script to customize, edit, or rewrite the spoken presentation words.

HOW TO USE:
1. Edit any of the spoken text strings in the `SCENES` dictionary below.
   - You can use commas `,` or ellipses `...` for natural breathing pauses.
2. Run this script in terminal:
   $ python3 work/generate_audio.py
3. Re-render the video anytime by running:
   $ python3 work/render_detailed_video_en.py
"""

import os
import subprocess
import shutil

# Voiceover Configuration
VOICE_NAME = "Aman"        # Fluent South Asian / Indian male voice (en_IN)
SPEECH_RATE = 142          # Relaxed, confident conversational pace (words per minute)
OUTPUT_MASTER = "work/master_audio.wav"
TEMP_DIR = "work/temp_audio"

# ==============================================================================
# SCRIPT CHAPTERS (Edit your narration text here)
# ==============================================================================
SCENES = [
    {
        "id": "scene_1_welcome",
        "title": "Chapter 1: Welcome & Our Story",
        "start_time_sec": 0.8,
        "text": (
            "Hello, and welcome. Today, we are proud to present... the Rotary Club of "
            "Shantinagar Dhaka. For over twenty years, our members have been working on the ground... "
            "bringing real help, care, and hope to communities across Bangladesh."
        )
    },
    {
        "id": "scene_2_leadership",
        "title": "Chapter 2: Dedicated Leadership & Governance",
        "start_time_sec": 16.8,
        "text": (
            "Behind every project, is strong and dedicated leadership. Led by our Club President... "
            "Rotarian Shah Arifur Rahman. Our Secretary... Rotarian Mohammad Shamim Rahman, "
            "and our passionate board members, we lead with trust, teamwork, and service."
        )
    },
    {
        "id": "scene_3_healthcare",
        "title": "Chapter 3: Caring for Mothers & Newborns",
        "start_time_sec": 32.6,
        "text": (
            "Healthcare is where our heart is. At Azimpur Maternity Hospital, we provided vital "
            "medical equipment for newborns. And right into the hands of mothers, we delivered over "
            "five hundred boxes... of nutritious food and essential care."
        )
    },
    {
        "id": "scene_4_water",
        "title": "Chapter 4: Clean Drinking Water in Schools",
        "start_time_sec": 47.6,
        "text": (
            "Clean water saves lives. At Sadik Model School, we set up a modern water filtration plant. "
            "Today, more than twelve hundred children drink pure, safe, arsenic-free water. "
        )
    },
    {
        "id": "scene_5_relief",
        "title": "Chapter 5: Winter Relief & Nationwide Green Drive",
        "start_time_sec": 61.6,
        "text": (
            "Whenever hardship strikes, our team is ready. We distributed over five thousand warm "
            "winter blankets to families in northern districts. And for our green future, we planted "
            "trees across all sixty-four districts of Bangladesh."
        )
    },
    {
        "id": "scene_6_transparency",
        "title": "Chapter 6: 100% Honest, Open & Accountable to You",
        "start_time_sec": 76.6,
        "text": (
            "We believe in complete honesty. Every single donation gets an instant digital receipt. "
            "And every penny we spend is openly published on our website... so you always know where your support goes."
        )
    },
    {
        "id": "scene_7_closing",
        "title": "Chapter 7: Join Our Journey & Contact",
        "start_time_sec": 90.6,
        "text": (
            "Our motto is simple: Service Above Self. We warmly invite you to be part of this journey. "
            "Visit Shantinagar Foundation dot org... and let us make a lasting difference, together."
        )
    }
]

def main():
    print("=" * 70)
    print("🎙️  Rotary Club of Shantinagar Dhaka - Audio Generator")
    print(f"    Voice: {VOICE_NAME} | Rate: {SPEECH_RATE} WPM")
    print("=" * 70)

    os.makedirs(TEMP_DIR, exist_ok=True)
    generated_wavs = []

    for idx, sc in enumerate(SCENES, 1):
        scene_id = sc["id"]
        aiff_path = os.path.join(TEMP_DIR, f"{scene_id}.aiff")
        wav_path = os.path.join(TEMP_DIR, f"{scene_id}.wav")

        print(f"\n▶ [{idx}/7] Synthesizing {sc['title']}...")
        print(f'   "{sc["text"]}"')

        # 1. Synthesize AIFF using macOS speech synthesizer
        subprocess.run([
            "say",
            "-v", VOICE_NAME,
            "-r", str(SPEECH_RATE),
            sc["text"],
            "-o", aiff_path
        ], check=True)

        # 2. Convert to broadcast-quality 48kHz Stereo WAV with warm studio EQ
        subprocess.run([
            "ffmpeg", "-y",
            "-i", aiff_path,
            "-af", "equalizer=f=180:t=q:w=1.2:g=2.5,equalizer=f=3200:t=q:w=1:g=-1.5,loudnorm=I=-16:TP=-1.5:LRA=11",
            "-ar", "48000",
            "-ac", "2",
            wav_path
        ], stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL, check=True)

        # Probe clip duration
        dur_str = subprocess.check_output([
            "ffprobe", "-v", "error",
            "-show_entries", "format=duration",
            "-of", "default=noprint_wrappers=1:nokey=1",
            wav_path
        ]).decode().strip()
        dur = float(dur_str)

        delay_ms = int(sc["start_time_sec"] * 1000)
        generated_wavs.append((wav_path, delay_ms))
        print(f"   ✅ Done: {dur:.2f}s (starts at {sc['start_time_sec']}s)")

    # 3. Assemble and Mix into Master Audio Track
    print("\n🎛️  Mixing into final master audio track (104.0s)...")
    inputs = []
    delays = []
    for i, (path, delay_ms) in enumerate(generated_wavs):
        inputs.extend(["-i", path])
        delays.append(f"[{i}]adelay={delay_ms}|{delay_ms}[a{i}]")

    filter_str = (
        ";".join(delays)
        + ";"
        + "".join(f"[a{i}]" for i in range(len(generated_wavs)))
        + f"amix=inputs={len(generated_wavs)}:dropout_transition=0:normalize=0,apad=whole_dur=104.0[out]"
    )

    cmd = ["ffmpeg", "-y"] + inputs + [
        "-filter_complex", filter_str,
        "-map", "[out]",
        "-t", "104.0",
        "-ar", "48000",
        "-ac", "2",
        OUTPUT_MASTER
    ]
    subprocess.run(cmd, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL, check=True)

    # 4. Clean up temporary individual scene clips
    shutil.rmtree(TEMP_DIR, ignore_errors=True)

    master_dur = subprocess.check_output([
        "ffprobe", "-v", "error",
        "-show_entries", "format=duration",
        "-of", "default=noprint_wrappers=1:nokey=1",
        OUTPUT_MASTER
    ]).decode().strip()

    print("=" * 70)
    print(f"🎉 Successfully generated master audio track: {OUTPUT_MASTER}")
    print(f"   Duration: {float(master_dur):.2f} seconds (Pure Voiceover, Zero Music)")
    print("   To re-render the video, simply run: python3 work/render_detailed_video_en.py")
    print("=" * 70)

if __name__ == "__main__":
    main()
