// Game setup
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

// Constants
const TILE_SIZE = 32;
const PLAYER_SCALE = 3;

// Initialize map and player
let map = {}; // All maps loaded from the backend
let currentMap = "spawn_map"; // Start map
let maps = {};

const player = {
    x: 8, // Starting column
    y: 6  // Starting row
};

// Load images
const images = {
    player: new Image(),
    wall: new Image(),
    ground: new Image(),
    cave: new Image(),
    oldMan: new Image()
};

images.player.src = "images/player.png";
images.wall.src = "images/tile.png";
images.ground.src = "images/ground.png";
images.cave.src = "images/cave.png";
images.oldMan.src = "images/oldman.png";

// Debug image loading
const loadedImages = [];
Object.keys(images).forEach((key) => {
    images[key].onload = () => {
        loadedImages.push(key);
        console.log(`${key} image loaded.`);
        if (loadedImages.length === Object.keys(images).length) {
            console.log("All images loaded!");
            loadMap(currentMap); // Ensure the map is loaded after images
        }
    };
    images[key].onerror = () => console.error(`Error loading image: ${key}`);
});

// Load map from PHP
function loadMap(mapName, callback) {
    fetch("map.php?map=" + mapName)
        .then(response => {
            if (!response.ok) throw new Error("Failed to fetch map data.");
            return response.json();
        })
        .then(data => {
            console.log("Map data loaded:", data); // Check the map data
            maps[mapName] = data;
            map = maps[mapName]; // Set current map
            if (callback) callback(); // Call the callback after the map is loaded
            drawGame();
        })
        .catch(err => console.error("Error loading map:", err));
}


function switchMap(newMap) {
    console.log(`Switching to ${newMap}`);
    if (!maps[newMap]) {
        // Load the map if not already loaded
        loadMap(newMap, () => {
            // Set player position based on the map
            if (newMap === "swordcave") {
                player.x = 8;
                player.y = 10;
            } else if (newMap === "spawn_map") {
                player.x = 5;
                player.y = 1;
            } else {
                // Default player position
                player.x = 8;
                player.y = 6;
            }
            drawGame();
        });
    } else {
        map = maps[newMap];
        currentMap = newMap;

        // Set player position based on the map
        if (newMap === "swordcave") {
            player.x = 8;
            player.y = 10;
        } else if (newMap === "spawn_map") {
            player.x = 5;
            player.y = 1;
        } else {
            // Default player position
            player.x = 8;
            player.y = 6;
        }

        drawGame();
    }
}


// Draw the game
function drawGame() {
    if (!map || !Array.isArray(map)) {
        console.warn("Map is empty or invalid. Cannot draw the game.");
        return;
    }

    console.log("Drawing game...");
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the map
    map.forEach((row, rowIndex) => {
        row.forEach((tile, colIndex) => {
            if (tile === 1) {
                // Draw obstacle tile
                ctx.drawImage(
                    images.wall,
                    colIndex * TILE_SIZE,
                    rowIndex * TILE_SIZE,
                    TILE_SIZE,
                    TILE_SIZE
                );
            } else if (tile === 'B') {
                // Draw cave entrance
                ctx.drawImage(
                    images.cave,
                    colIndex * TILE_SIZE,
                    rowIndex * TILE_SIZE,
                    TILE_SIZE,
                    TILE_SIZE
                );
            } else if (tile === 'W') {
                // Draw water or specific ground tile
                ctx.drawImage(
                    images.ground,
                    colIndex * TILE_SIZE,
                    rowIndex * TILE_SIZE,
                    TILE_SIZE,
                    TILE_SIZE
                );
            } else if (tile === 'O') {
                // Draw Old Man tile
                ctx.drawImage(
                    images.oldMan,
                    colIndex * TILE_SIZE,
                    rowIndex * TILE_SIZE,
                    TILE_SIZE,
                    TILE_SIZE
                );
            } else if (tile === 0 || tile === '0') {
                // Walkable tile, apply map-specific logic
                if (currentMap === "swordcave") {
                    ctx.drawImage(
                        images.cave,
                        colIndex * TILE_SIZE,
                        rowIndex * TILE_SIZE,
                        TILE_SIZE,
                        TILE_SIZE
                    );
                } else {
                    ctx.drawImage(
                        images.ground,
                        colIndex * TILE_SIZE,
                        rowIndex * TILE_SIZE,
                        TILE_SIZE,
                        TILE_SIZE
                    );
                }
            } else {
                // Default fallback for unexpected tiles
                ctx.fillStyle = "pink"; // Debug color for unhandled tiles
                ctx.fillRect(
                    colIndex * TILE_SIZE,
                    rowIndex * TILE_SIZE,
                    TILE_SIZE,
                    TILE_SIZE
                );
            }
        });
    });
    

    // Draw the player
    ctx.drawImage(
        images.player,
        player.x * TILE_SIZE + (TILE_SIZE - TILE_SIZE * PLAYER_SCALE) / 2,
        player.y * TILE_SIZE + (TILE_SIZE - TILE_SIZE * PLAYER_SCALE) / 2,
        TILE_SIZE * PLAYER_SCALE,
        TILE_SIZE * PLAYER_SCALE
    );

    console.log("Game drawn successfully.");
}

// Handle keyboard input
window.addEventListener("keydown", (event) => {
    const { x, y } = player;

    // Define movement conditions
    if (event.key === "ArrowUp" && map[y - 1]?.[x] === 0) player.y--;
    if (event.key === "ArrowUp" && map[y - 1]?.[x] === 'B') {
        player.y--;
        switchMap("swordcave");
        return;
    }
    if (event.key === "ArrowDown" && map[y + 1]?.[x] === 0) player.y++;
    if (event.key === "ArrowDown" && map[y + 1]?.[x] === 'W') {
        player.y++;
        switchMap("spawn_map");
        return;
    }
    if (event.key === "ArrowLeft" && map[y]?.[x - 1] === 0) player.x--;
    if (event.key === "ArrowRight" && map[y]?.[x + 1] === 0) player.x++;

    drawGame();
});
