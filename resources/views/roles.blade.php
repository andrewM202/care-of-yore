<x-app-layout>
    <body>
        <div id='roles'>
            <table class='table-auto'>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Access Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Admin</th>
                        <td>0</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <form method="POST">
            <div id='roleCreation'>
                <label for='newRole'>New Role</label>
                <input type='text' name='newRole'>
                <label for='accessLevel'>Access Level</label>
                <input type='number' min="0" name='accessLevel'>
            </div>
            <button type="submit">Ok</button>
            <button type="reset">Cancel</button>
        </form>
    </body>
</x-app-layout>
