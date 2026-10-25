# Composition Brief: Rotary Club of Shantinagar Dhaka

## Objective
Render a high-impact, 20-second 1080p presentation video showcasing the humanitarian platform of Rotary Club of Shantinagar Dhaka (District 3281) for executive review, stakeholder presentation, and public launch.

## Output Specs
- Resolution: 1920x1080 (16:9 Landscape)
- Framerate: 30 FPS (600 frames total)
- Duration: 20.0 seconds
- Render Target: `brag-output/brag.mp4`
- Poster Image: `brag-output/brag.jpg` (baked into frame 0)
- Audio: Rhythmic 109.96 BPM civic soundtrack (`happy-beats-business-moves-vol-10-by-ende-dot-app.mp3`) with soft fade-out at 18.5s–20.0s.

## Assets Employed
- Logo: `public/assets/images/logo.png` (Rotary International District 3281)
- Scene 1: Golden emblem crest, deep midnight blue backdrop (#001a33 -> #003366)
- Scene 2: Hospital handover (`public/assets/images/gallery-albums/health-and-medical-aid/medical-equipment-hospital-handover.jpeg`) & nutrition pack handover (`public/assets/images/gallery-albums/community-service-and-relief/pushti-nutrition-handover-mother.jpeg`)
- Scene 3: Clean drinking water purifier with school children (`public/assets/images/gallery-albums/community-service-and-relief/water-purifier-installation-children.jpeg`)
- Scene 4: District leadership line-up (`public/assets/images/gallery-albums/awards-and-recognition/district-conference-stage-lineup.jpeg`) + verified transparency badges
- Scene 5: Rotary crest, "Service Above Self", Dhaka Bangladesh

## Motion Principles
- Easing: Smooth cubic-bezier ease-in-out (`t => t < 0.5 ? 4*t*t*t : 1 - Math.pow(-2*t + 2, 3)/2`)
- Ken Burns subtle scale: 1.0 -> 1.08 over each scene duration
- Glassmorphic stat overlay cards with golden rotary accents and subtle drop shadows
- Readable typography settled before scene transitions
