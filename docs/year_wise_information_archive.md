# Rotary Club of Shantinagar Dhaka — Year-Wise Information Archive & System Architecture

## 1. Executive Overview & Rotary Calendar Standard

In Rotary International, administrative terms, board tenures, and financial operations follow the **Rotary Year (RY)** cycle running from **July 1 to June 30**:
* **Current Operational Year:** **RY 2026–2027** (July 1, 2026 – June 30, 2027)
* **Upcoming / Past Years:** Archival records organized year-wise (e.g. RY 2025–2026, RY 2024–2025, RY 2023–2024, etc.)

All data currently loaded into the system (Board of Directors, attendance rosters, humanitarian service projects, donations, and audited vouchers) represents **this current year (RY 2026–2027)**. Past year records will be ingested modularly into dedicated year-wise repositories as provided.

---

## 2. Media Segregation: Final 18 BOD vs. Unfinalized Members

As per leadership directive:
* **Finalized Images:** Only the **18 Board of Directors members for RY 2026–2027** have final studio portraits. These reside exclusively in [`public/assets/images/members/`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/public/assets/images/members/).
* **Unfinalized Images:** All 44 non-BOD portraits (ground staff, past presidents, active Rotarians) have been relocated to [`public/assets/images/members/unfinalized/`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/public/assets/images/members/unfinalized/) awaiting future review and finalization.

### Dynamic Image Resolution Architecture
The [`Employee`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/app/Models/Employee.php) model automatically resolves photo paths through `getPhotoUrlAttribute()`:
1. Checks if the file exists in the active directory (`assets/images/members/`).
2. Checks if the file exists in the unfinalized directory (`assets/images/members/unfinalized/`).
3. If neither is available, cleanly falls back to the official SVG/JPEG placeholder (`assets/images/members/member-placeholder.jpg`).

---

## 3. RY 2026–2027: Official Board of Directors (18 Members — Final Portraits)

| SL | Name & Honors | Official Designation | Rotary ID | Phone | Photo File | Status |
| :---: | :--- | :--- | :---: | :--- | :--- | :---: |
| **01** | **Rtn. Shah Arifur Rahman** | President | 11706994 | +8801711568209 | `assets/images/members/rtn-shah-arifur-rahman.jpg` | **FINAL ✅** |
| **02** | **Rtn. Md Mominul Islam** | Immediate Past President (IPP) | 11238541 | +8801711046889 | `assets/images/members/rtn-mominul-islam.jpg` | **FINAL ✅** |
| **03** | **Rtn. Ujjal Kanti Dey** | President Elect | 11355216 | +8801711043170 | `assets/images/members/rtn-ujjal-kanti-dey.jpg` | **FINAL ✅** |
| **04** | **Rtn. Fahima Nazneen Rahman, RFSM** | Vice President | 11416650 | +8801715004199 | `assets/images/members/rtn-fahima-nazneen-rahman.jpg` | **FINAL ✅** |
| **05** | **Engr. Md. Abul Kalam Azad** | President Nominee | 11223728 | +8801711435748 | `assets/images/members/rtn-abul-kalam-azad.jpg` | **FINAL ✅** |
| **06** | **Rtn. Md. Shamim Rahman** | Secretary | 11762886 | +8801674888898 | `assets/images/members/rtn-shamim-rahman.jpg` | **FINAL ✅** |
| **07** | **Rtn. Md. Shafiqul Islam** | Assistant Secretary | 11392949 | +8801718262628 | `assets/images/members/rtn-shafiqul-islam.jpg` | **FINAL ✅** |
| **08** | **Rtn. Md Shariful Islam Shovo** | Treasurer | 12132695 | +8801767720716 | `assets/images/members/rtn-shariful-islam-shovo.jpg` | **FINAL ✅** |
| **09** | **Rtn. Md. Mofidul Islam Talukder** | Assistant Treasurer | 11664813 | +8801711238178 | `assets/images/members/rtn-mofidul-islam-talukder.jpg` | **FINAL ✅** |
| **10** | **Rtn. Md. Abdul Halim Chowdhury, MPHF** | Club Facilitator | 8499414 | +8801711612780 | `assets/images/members/rtn-abdul-halim-chowdhury.jpg` | **FINAL ✅** |
| **11** | **Dr. Md. Rafiqul Islam** | Bulletin Editor | 11620567 | +8801714073391 | `assets/images/members/rtn-rafiqul-islam.jpg` | **FINAL ✅** |
| **12** | **Rtn. KM Ali Hasan (Tuhin)** | Sergeant at Arms | 11665818 | +8801720688808 | `assets/images/members/rtn-ali-hasan-tuhin.jpg` | **FINAL ✅** |
| **13** | **Rtn. Mohammad Kamrul Hasan, MPHF** | Director (Administration) | 9747756 | +8801711931663 | `assets/images/members/rtn-kamrul-hasan.jpg` | **FINAL ✅** |
| **14** | **Rtn. Nabegah Dordana** | Director (The Rotary Foundation) | 6956964 | +8801819405000 | `assets/images/members/rtn-nabegah-dordana.jpg` | **FINAL ✅** |
| **15** | **Rtn. Md. Nasir Uddin Pramanik, RFSM** | Director (Membership) | 8125697 | +8801915398213 | `assets/images/members/rtn-nasir-uddin-pramanik.jpg` | **FINAL ✅** |
| **16** | **Rtn. Fayeem Anjum Ibne Farid** | Director (The Rotary Foundation) | 11457745 | +8801713000222 | `assets/images/members/member-placeholder.jpg` | **FINAL (Placeholder) ✅** |
| **17** | **Rtn. Sinthia Shahariar** | Director (Public Image) | 11355211 | +8801962400391 | `assets/images/members/rtn-sinthia-shahariar.jpg` | **FINAL ✅** |
| **18** | **Rtn. Md Abdur Rahim** | Director (Youth Service) | 11825293 | +8801718232918 | `assets/images/members/rtn-abdur-rahim.jpg` | **FINAL ✅** |

---

## 4. Year-Wise Directory Hierarchy

The project documentation, curated CSVs, and raw source documents are now cleanly partitioned year-wise:

```text
├── docs/
│   ├── year_wise_information_archive.md          # Master architecture and year registry
│   └── curated-data/
│       ├── RY-2026-2027/                         # Current Year Curated Datasets
│       │   ├── rotary_members_list.csv           # 74 verified club members (RY 2026-27)
│       │   ├── rotary_projects_list.csv          # 12 active humanitarian projects
│       │   ├── donations_and_contributions_list.csv # Itemized donations & SAD funds
│       │   ├── project_and_event_expenses.csv    # Audited expenditures
│       │   ├── member_donation_project_curation.md
│       │   └── project_expenses_and_docs_audit.md
│       ├── RY-2025-2026/                         # [Awaiting user input for previous year]
│       └── RY-2024-2025/                         # [Awaiting user input for previous year]
│
├── public/assets/
│   ├── documents/
│   │   ├── curated/
│   │   │   ├── RY-2026-2027/                     # Web-accessible curated CSVs (2026-27)
│   │   │   ├── RY-2025-2026/                     # Dedicated folder for previous year
│   │   │   └── RY-2024-2025/                     # Dedicated folder for previous year
│   │   └── source-docs/
│   │       ├── RY-2026-2027/                     # Original 2026-27 Board PDF, meeting sheets, receipts
│   │       ├── RY-2024-2025/                     # Jan '25 to Dec '25 project documents
│   │       └── previous-years/                   # Future previous-year intake
│   │
│   └── images/
│       └── members/
│           ├── [17 BOD JPGs + placeholder]       # 100% FINAL 18 BOD Portraits (RY 2026-27)
│           └── unfinalized/                      # 44 Non-BOD portraits awaiting user final review
```

---

## 5. Year-Wise Database Scopes & Query Methods

All Eloquent models now support native Rotary Year filtering:

### `Employee` Model Scopes
```php
// Fetch only the 18 Board of Directors members
$bod = Employee::boardOfDirectors()->get();

// Fetch only employees active in the current Rotary Year (2026-2027)
$currentYearMembers = Employee::currentYear()->get();

// Query a specific Rotary Year
$pastMembers = Employee::rotaryYear('2024–2025')->get();
```

### `Project`, `Donation`, & `Expense` Model Scopes
```php
// Projects active within Rotary Year 2026-2027 (July 1, 2026 to June 30, 2027)
$projects2026 = Project::rotaryYear(2026)->get();

// Donations collected in Rotary Year 2026-2027
$donations2026 = Donation::rotaryYear(2026)->get();

// Audited expenses within Rotary Year 2026-2027
$expenses2026 = Expense::rotaryYear(2026)->get();

// Query previous year (RY 2025-2026)
$donations2025 = Donation::rotaryYear(2025)->get();
```

---

## 6. Guidelines for Ingesting Previous Years' Data

When the user provides previous years' documents (e.g. RY 2025–2026 or RY 2024–2025):
1. **Source Documents:** Store raw PDFs/Excel sheets in `public/assets/documents/source-docs/RY-[Year]/`.
2. **Curated CSVs:** Place structured data into `docs/curated-data/RY-[Year]/` and sync to `public/assets/documents/curated/RY-[Year]/`.
3. **Database Seeders:** Append historical records with explicit `tenure` and `year_badge` attributes (`RY 2025–2026`, etc.) and `order_index` offsets to prevent collision with the active BOD.
4. **Member Portraits:** Keep pending historical photos in `public/assets/images/members/unfinalized/` until the user confirms their final status.
