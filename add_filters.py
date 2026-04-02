import os, glob

views = glob.glob('c:/xampp/htdocs/Ex_StudentERP/view/**/*.php', recursive=True)

for v in views:
    with open(v, 'r', encoding='utf-8') as f:
        content = f.read()
        
    if 'id="tableSearch"' in content and 'id="tableFilter"' not in content:
        options = '<option value="">All</option>'
        if 'performance' in v:
            options += '<option value="pass">Pass</option><option value="fail">Fail</option>'
        elif 'examination' in v:
            options += '<option value="Upcoming">Upcoming</option><option value="Completed">Completed</option><option value="Ongoing">Ongoing</option>'
        elif 'fees' in v:
            options += '<option value="paid">Paid</option><option value="pending">Pending</option><option value="overdue">Overdue</option>'
        elif 'students' in v:
            options += '<option value="active">Active</option><option value="inactive">Inactive</option><option value="graduated\">Graduated</option><option value="suspended\">Suspended</option>'
        else:
            options += '<option value="active">Active</option><option value="inactive">Inactive</option>'
            
        select_html = f'<select id="tableFilter" class="form-select form-select-sm me-2" style="width:120px">{options}</select>'
        
        target1 = '<input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Search…" style="width:200px">'
        target2 = '<input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Quick filter…" style="width:200px">'
        
        target = None
        if target1 in content:
            target = target1
        elif target2 in content:
            target = target2
            
        if target:
            replacement = f'<div class="d-flex">{select_html}{target}</div>'
            content = content.replace(target, replacement)
            with open(v, 'w', encoding='utf-8') as f:
                f.write(content)
            print('Updated', v)
