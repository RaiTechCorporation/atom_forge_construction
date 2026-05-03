import re
with open(r'r:\Construction\atom_forge_construction\resources\views\layouts\sidebar.blade.php', encoding='utf-8') as f:
    content = f.read()

directives = ['if', 'endif', 'else', 'elseif', 'unless', 'endunless', 'foreach', 'endforeach', 'php', 'endphp', 'for', 'endfor', 'while', 'endwhile']
for d in directives:
    count = len(re.findall(rf'@{d}\b', content))
    print(f'{d}: {count}')
